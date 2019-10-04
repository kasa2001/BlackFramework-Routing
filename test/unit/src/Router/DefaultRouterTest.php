<?php


namespace Unit\Router;


use BlackFramework\Routing\Exception\NotFound;
use BlackFramework\Routing\Exception\RouterException;
use BlackFramework\Routing\Factory\IFactory;
use BlackFramework\Routing\Parser\WebParser;
use BlackFramework\Routing\Router\DefaultRouter;
use BlackFramework\Routing\Router\IRouter;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Framework\TestCase;
use Unit\Mock\ControllerMock;
use Unit\Mock\ServiceMock;

class DefaultRouterTest extends TestCase
{
    private $service;
    private $parser;
    private $factory;

    protected function setUp(): void
    {
        $this->parser = $this->createMock(WebParser::class);

        $this->factory = $this->createMock(IFactory::class);

        $this->service = new DefaultRouter(
            $this->parser,
            $this->factory
        );

        $this->service->configure(
            [
                //Controller constructor params
                'controller-params' => [
                    ControllerMock::class => [
                        ServiceMock::class,
                    ],
                ],
                //Route definition
                'route-definition' => [
                    //method
                    'GET' => [
                        //route
                        'home' => [
                            'index' => [
                                'controller' => ControllerMock::class,
                                'action' => 'select',
                                //Required parameters in url
                                'required' => [
                                    // type => pattern
                                    'id' => '\d+',
                                    'character' => IRouter::KEYWORD
                                ],
                                'optional' => [

                                ],
                                'query' => [
                                    "index",
                                ],
                            ],
                        ],
                    ],
                    'POST' => [

                    ],
                    'PUT' => [

                    ],
                ],
                'default-route' => [
                    'controller' => ControllerMock::class,
                    'action' => 'index',
                    'parameters' => [

                    ],
                ]
            ]
        );
        parent::setUp();
    }

    /**
     * @throws RouterException
     */
    public function testExecute()
    {
        $this->factory->method('createObject')
            ->willReturn(new ControllerMock(new ServiceMock()));


        $actual = $this->service->execute(
            ControllerMock::class,
            'index',
            [
                "a"
            ]
        );

        $this->assertEquals("a", $actual);
    }

    /**
     * @throws RouterException
     */
    public function testExecuteClassError()
    {
        $this->expectException(NotFound::class);

        $this->service->execute(
            "Not Exists",
            'index',
            [
                "a"
            ]
        );
    }

    /**
     * @throws RouterException
     */
    public function testExecuteMethodError()
    {
        $this->expectException(NotFound::class);

        $this->service->execute(
            ControllerMock::class,
            'Not Exists',
            [
                "a"
            ]
        );
    }
}