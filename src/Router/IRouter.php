<?php


namespace BlackFramework\Routing\Router;

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
     * @param int $code
     * @param string $applicationPath
     * @return string
     */
    public function executeException(int $code, string $applicationPath);

    /**
     * Redirect to another page
     * @param string $url
     * @return mixed
     */
    public function redirect(string $url);
}