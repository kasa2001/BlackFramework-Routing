<?php


namespace BlackFramework\Routing\Parser;


use BlackFramework\Routing\Container\WebContainer;
use BlackFramework\Routing\Part\Header;
use BlackFramework\Routing\Part\Host;
use BlackFramework\Routing\Part\Method;
use BlackFramework\Routing\Part\Query;
use BlackFramework\Routing\Part\Segment;

class WebParser implements IParser
{
    /**
     * @var WebContainer
     */
    private $container;

    public function parse()
    {
        $this->container = new WebContainer(
            new Segment(
                explode('/',
                    trim($_SERVER['REDIRECT_URL'] ?? '', '/')
                )
            ),
            new Host(
                $_SERVER['HTTP_HOST']
            ),
            new Method(
                $_SERVER['REQUEST_METHOD']
            ),
            new Query(
                $_REQUEST
            ),
            new Header(
                $this->getAllHeaders()
            )
        );
    }

    /**
     * @return WebContainer
     */
    public function getContainer()
    {
        return $this->container;
    }


    private function getAllHeaders(): array
    {
        $array = [];

        foreach ($_SERVER as $key => $value) {
            if (preg_match('/^HTTP_(.+)/', $key, $match)) {
                $array[$match[1]] = $value;
            }
        }

        return $array;
    }

}
