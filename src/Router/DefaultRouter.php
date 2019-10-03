<?php


namespace BlackFramework\Routing\Router;

use ReflectionClass;
use ReflectionException;

use BlackFramework\Routing\Exception\NotFound;
use BlackFramework\Routing\Factory\IFactory;
use BlackFramework\Routing\Parser\IParser;
use BlackFramework\Routing\Parser\WebParser;

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
     */
    public function choose(): array
    {
//        $this->parser->parse();
//        $container = $this->parser->getContainer();

        return [
            'controller' => '',
            'method' => '',
            'parameters' => [

            ],
        ];
    }

    /**
     * Configuration for router
     * Keys in array:
     * ['controller'] Controller Namespace
     * ['router-definition'] Route Definition. Default config: /{controller}/{method}/{param1}/{param2} ...
     * ['controller-params'] Controller parameters type to create controller class
     * @param array $configuration
     */
    public function configure(array $configuration): void
    {
        $this->configuration['controller'] = $configuration['controller'];
        $this->configuration['controller-params'] = $configuration['controller-params'];
        $this->configuration['route-definition'] = $configuration['route-definition'];
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

}