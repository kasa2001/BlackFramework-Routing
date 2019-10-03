<?php


namespace Unit\Mock;


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
}