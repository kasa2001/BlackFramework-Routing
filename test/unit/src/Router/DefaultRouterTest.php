<?php


namespace Unit\Router;


use BlackFramework\Routing\Exception\NotFound;
use BlackFramework\Routing\Exception\RouterException;
use BlackFramework\Routing\Factory\IFactory;
use BlackFramework\Routing\Parser\WebParser;
use BlackFramework\Routing\Router\DefaultRouter;
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
                'controller' => 'Unit\\Mock',
                'controller-params' => [
                    ControllerMock::class => [
                        ServiceMock::class
                    ]
                ],
                'route-definition' => [
                    '{controller}/{method}/{id}'
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