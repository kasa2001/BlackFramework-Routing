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
     * @return string
     */
    public function getPart(): string
    {
        return $this->host;
    }
}