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

    public function checkPart(IPart $part): bool
    {
        return false;
    }

    public function getPart()
    {
        return $this->segment;
    }


}
