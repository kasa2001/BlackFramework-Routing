<?php


namespace Unit\Mock;


use BlackFramework\Routing\Container\WebContainer;

class ControllerMock
{
    /**
     * @var ServiceMock
     */
    private $service;

    public function __construct(ServiceMock $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return "a";
    }

    public function select(int $id, WebContainer $container)
    {

    }
}