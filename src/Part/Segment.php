<?php


namespace BlackFramework\Routing\Part;

class Segment implements IPart
{
    /**
     * @var array
     */
    private $segment;

    /**
     * @param array $segment
     */
    public function __construct(array $segment)
    {
        $this->segment = $segment;
    }

    public function getPart()
    {
        return $this->segment;
    }


}
