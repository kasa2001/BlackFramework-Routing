<?php


namespace BlackFramework\Routing\Router;

interface IRouter
{
    /**
     * Method select Controller and method
     * @return array
     */
    public function choose() : array;

    /**
     * Method insert application configuration to Router class
     * @param $configuration array
     */
    public function configure(array $configuration) : void;

    /**
     * Method execute selected route
     * @param $controller
     * @param $method
     * @param array $parameters
     * @return mixed
     */
    public function execute($controller, $method, $parameters = []);
}