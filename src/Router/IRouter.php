<?php


namespace BlackFramework\Routing\Router;

use BlackFramework\Routing\Exception\RouterException;

interface IRouter
{
    const KEYWORD = -1;

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

    /**
     * @param RouterException $exception
     * @param string $applicationPath
     * @param string $type
     * @return string
     */
    public function executeException(RouterException $exception, string $applicationPath, string $type): string;

    /**
     * Redirect to another page
     * @param string $url
     * @return void
     */
    public function redirect(string $url): void;
}