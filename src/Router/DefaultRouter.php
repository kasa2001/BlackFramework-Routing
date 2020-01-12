<?php


namespace BlackFramework\Routing\Router;

use BlackFramework\Routing\Exception\BadRequest;
use BlackFramework\Routing\Exception\InternalServerError;
use BlackFramework\Routing\Exception\RouterException;
use BlackFramework\Routing\Exception\NotFound;
use BlackFramework\Routing\Factory\IFactory;
use BlackFramework\Routing\Parser\IParser;
use BlackFramework\Routing\Parser\WebParser;
use BlackFramework\Routing\Repository\Exception\RepositoryException;
use BlackFramework\Routing\Repository\IRepository;

use ReflectionClass;
use ReflectionException;

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

    /**
     * @var IFactory
     */
    private $entityFactory;

    public function __construct(IParser $parser, IFactory $factory, IFactory $entityFactory)
    {
        $this->parser = $parser;
        $this->factory = $factory;
        $this->entityFactory = $entityFactory;
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
     * default configuration {domain}/{controller}/{method}/{param1}/{param2} ...
     * @param array $configuration
     */
    public function configure(array $configuration): void
    {
        $this->configuration['controller-params'] = $configuration['controller-params'] ?? [];
        $this->configuration['route-definition'] = $configuration['route-definition'] ?? [];
        $this->configuration['default-route'] = $this->configuration['default-route'] ?? [];
    }

    /**
     * {@inheritDoc}
     * @throws NotFound if class or method not found
     */
    public function execute($controller, $action, $parameters = [])
    {
        try {
            $class = new ReflectionClass($controller);

            if (!$class->hasMethod($action)) {
                throw new NotFound();
            }

        } catch (ReflectionException $exception) {
            throw new NotFound();
        }

        $object = $this->factory->createObject(
            $class,
            $this->configuration['controller-params'][$controller]
        );

        return $object->$action(...$parameters);
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
                array_keys($this->configuration[$method]),
                implode("/", $segment)
            );

            $route = $this->configuration[$method][$pattern] ?? 0;

            if (!$route) {
                //Get default controller and method (from URL address)
                return [
                    'controller' => $segment[0],
                    'method' => $segment[1] ?? 'index',
                    'parameters' => [
                        $this->parser->getContainer()
                    ]
                ];
            }

            $queryParams = $route['query'] ?? 0;

            if ($queryParams) {
                $this->checkParams(
                    $queryParams,
                    array_keys($query)
                );
            }

            //@TODO build parameters
            return [
                'controller' => $route['controller'],
                'method' => $route['action'],
                'parameters' => [
                    $this->parser->getContainer()
                ]
            ];
        }

        return $this->configuration['default-route'];
    }

    /**
     * @param $required
     * @return array
     * @throws RouterException
     */
    private function buildParams($required)
    {
        $i = 2;
        $segment = $this->parser->getContainer()->getSegment()->getPart();

        $params = [];
        try {

            foreach ($required as $key => $item) {
                if ($item != IRouter::KEYWORD) {
                    $repository = new $key();

                    if (in_array(IRepository::class, class_implements($repository))) {
                        throw new InternalServerError();
                    }
                    $params[] = $this->entityFactory->createObject(
                        new ReflectionClass($item),
                        $repository->findEntity([
                            'url' => $segment[$i]
                        ])
                    );
                }
                $i++;
            }
        } catch (ReflectionException $e) {
            throw new BadRequest();
        } catch (RepositoryException $e) {
            throw new NotFound();
        }

        $params[] = $this->parser->getContainer();

        return $params;
    }

    /**
     * @param array $keys
     * @param string $segment
     * @return mixed|null
     */
    private function pregPattern(array $keys, string $segment)
    {
        foreach ($keys as $key) {
            if (preg_match("/" . addslashes($key) . "/", $segment)) {
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
                throw new BadRequest();
            }
        }
    }

}