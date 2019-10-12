<?php


namespace BlackFramework\Routing\Part;


class Host implements IPart
{
    /**
     * @var string
     */
    private $host;

    /**
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed|string
     */
    public function getPart()
    {
        return $this->host;
    }
}