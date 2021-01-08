<?php


namespace BlackFramework\Routing\Container;


use BlackFramework\Routing\Part\Body;
use BlackFramework\Routing\Part\Header;
use BlackFramework\Routing\Part\Host;
use BlackFramework\Routing\Part\Method;
use BlackFramework\Routing\Part\Query;
use BlackFramework\Routing\Part\Segment;

class WebContainer implements IContainer
{
    /**
     * @var Segment
     */
    private $segment;

    /**
     * @var Host
     */
    private $host;

    /**
     * @var Method
     */
    private $method;

    /**
     * @var Query
     */
    private $query;

    /**
     * @var Header
     */
    private $header;

    /**
     * @var Body
     */
    private $body;

    public function __construct(Segment $segment, Host $host, Method $method, Query $query, Header $header, Body $body)
    {
        $this->segment = $segment;
        $this->host = $host;
        $this->method = $method;
        $this->query = $query;
        $this->header = $header;
        $this->body = $body;
    }

    /**
     * @return Segment
     */
    public function getSegment(): Segment
    {
        return $this->segment;
    }

    /**
     * @return Host
     */
    public function getHost(): Host
    {
        return $this->host;
    }

    /**
     * @return Method
     */
    public function getMethod(): Method
    {
        return $this->method;
    }

    /**
     * @return Query
     */
    public function getQuery(): Query
    {
        return $this->query;
    }

    /**
     * @return Header
     */
    public function getHeader(): Header
    {
        return $this->header;
    }

    /**
     * @return Body
     */
    public function getBody(): Body
    {
        return $this->body;
    }

}