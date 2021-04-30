<?php


namespace BlackFramework\Routing\Router;

use BlackFramework\Routing\Exception\BadRequest;
use BlackFramework\Routing\Exception\ConfigurationRequired;
use BlackFramework\Routing\Exception\InternalServerError;
use BlackFramework\Routing\Exception\QueryParameterRequired;
use BlackFramework\Routing\Exception\RouterException;
use BlackFramework\Routing\Exception\NotFound;
use BlackFramework\Routing\Factory\IFactory;
use BlackFramework\Routing\Parser\IParser;
use BlackFramework\Routing\Parser\WebParser;

use BadMethodCallException;
use ReflectionClass;
use ReflectionException;
use Throwable;

class DefaultRouter implements IRouter
{
    /**
     * @var array
     */
    private $configuration;

    /**
     * @var WebParser
     */
    private $parser;

    /**
     * @var IFactory
     */
    private $factory;

    public function __construct(IParser $parser, IFactory $factory)
    {
        $this->parser = $parser;
        $this->factory = $factory;
    }

    /**
     * {@inheritDoc}
     * @throws RouterException
     */
    public function choose(): array
    {
        $this->parser->parse();
        $container = $this->parser->getContainer();

        $method = $container->getMethod();
        $segment = $container->getSegment();
        $query = $container->getQuery();


        return $this->findRoute(
            $method->getPart(),
            $segment->getPart(),
            $query->getPart()
        );
    }

    /**
     * Configuration for router
     * Keys in array:
     * ['router-definition'] Route Definition. Default config: '^/{controller}/{method}$'
     * ['controller-params'] Controller parameters type to create controller class
     * ['default-route'] Default route definition
     * ['controller-namespace'] Controller namespace
     * @param array $configuration
     */
    public function configure(array $configuration): void
    {
        $this->configuration['controller-params'] = $configuration['controller-params'] ?? [];
        $this->configuration['route-definition'] = $configuration['route-definition'] ?? [];
        $this->configuration['default-route'] = $configuration['default-route'] ?? [];
        $this->configuration['controller-namespace'] = $configuration['controller-namespace'] ?? "App\\Controller\\";
    }

    /**
     * {@inheritDoc}
     * @throws InternalServerError
     * @throws NotFound
     * @throws RouterException
     */
    public function execute($controller, $method, $parameters = [])
    {
        try {
            $class = new ReflectionClass($controller);

            if (!$class->hasMethod($method)) {
                throw new InternalServerError(new BadMethodCallException());
            }

        } catch (ReflectionException $exception) {
            throw new NotFound($exception);
        }

        try {
            $object = $this->factory->createObject(
                $class,
                $this->configuration['controller-params'][$controller]
            );

            return $object->$method(...$parameters);
        } catch (Throwable $e) {
            throw new InternalServerError($e);
        }
    }

    /**
     * {@inheritDoc}
     * @param string $url
     * @return void
     */
    public function redirect(string $url): void
    {
        header("Location: {$url}");
        die();
    }

    /**
     * @param RouterException $exception
     * @param string $applicationPath
     * @param string $type
     * @return string
     */
    public function executeException(RouterException $exception, string $applicationPath, string $type = "html"): string
    {
        header("HTTP/2.0 {$exception->getCode()} {$exception->getMessage()}");
        ob_start();
        include $applicationPath . "/public/error/error{$exception->getCode()}.{$type}";
        return ob_get_clean();
    }

    /**
     * @param string $method
     * @param array $segment
     * @param array $query
     * @return array
     * @throws RouterException
     */
    private function findRoute(string $method = "GET", array $segment = [], array $query = []): array
    {
        if (count($segment)) {
            $pattern = $this->pregPattern(
                array_keys($this->configuration['route-definition'][$method]),
                implode("/", $segment)
            );

            $route = $this->configuration['route-definition'][$method][$pattern] ?? 0;


            if (!$route) {
                throw new NotFound(
                    new ConfigurationRequired()
                );
            }

            $queryParams = $route['query'] ?? 0;

            if ($queryParams) {
                $this->checkParams(
                    $queryParams,
                    array_keys($query)
                );
            }

            return [
                'controller' => $route['controller'],
                'action' => $route['action'],
                'parameters' => [
                    $this->parser->getContainer()
                ]
            ];
        }

        return $this->configuration['default-route'];
    }

    /**
     * @param array $keys
     * @param string $segment
     * @return mixed|null
     */
    private function pregPattern(array $keys, string $segment)
    {
        foreach ($keys as $key) {
            if (preg_match("/" . addcslashes($key, "/") . "/", $segment)) {
                return $key;
            }
        }

        return null;
    }

    /**
     * @param array $queryParams
     * @param array $keys
     * @throws BadRequest
     */
    private function checkParams(array $queryParams, array $keys)
    {
        foreach ($queryParams as $key) {
            if (!in_array($key, $keys)) {
                throw new BadRequest(
                    new QueryParameterRequired()
                );
            }
        }
    }

}