<?php


namespace BlackFramework\Routing\Part;

class Header implements IPart
{

    /**
     * @var array
     */
    private $header;

    /**
     * @param array $header
     */
    public function __construct(array $header)
    {
        $this->header = $header;
    }

    /**
     * @param IPart $part
     * @return bool
     */
    public function checkPart(IPart $part): bool
    {
        return false;
    }

    /**
     * @return array|mixed
     */
    public function getPart()
    {
        return $this->header;
    }

}
