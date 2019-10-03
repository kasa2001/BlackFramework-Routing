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
     * @param IPart $part
     * @return bool
     */
    public function checkPart(IPart $part): bool
    {
        return $this->host == $part->getPart();
    }

    /**
     * @return mixed|string
     */
    public function getPart()
    {
        return $this->host;
    }
}