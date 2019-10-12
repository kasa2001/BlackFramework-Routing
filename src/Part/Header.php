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
     * @return array|mixed
     */
    public function getPart()
    {
        return $this->header;
    }

}
