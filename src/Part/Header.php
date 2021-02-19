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
     * @return array
     */
    public function getPart(): array
    {
        return $this->header;
    }

}
