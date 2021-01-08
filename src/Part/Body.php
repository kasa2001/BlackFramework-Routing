<?php


namespace BlackFramework\Routing\Part;


use function json_decode;
use function json_last_error;

class Body
{
    /**
     * @var object
     */
    private $body;

    public function __construct($body)
    {
        $this->body = $this->parseBody($body);
    }

    /**
     * @return object
     */
    public function getBody()
    {
        return $this->body;
    }

    private function parseBody($body)
    {
        $object = json_decode($body);

        return json_last_error() ? $body : $object;
    }
}