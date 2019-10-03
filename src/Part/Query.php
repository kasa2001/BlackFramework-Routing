<?php


namespace BlackFramework\Routing\Part;

class Query implements IPart
{
    /**
     * @var array
     */
    private $query;

    /**
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->query = $request;
    }

    public function checkPart(IPart $part): bool
    {
        return false;
    }

    public function getPart()
    {
        return $this->query;
    }


    public function toString()
    {
        return '';
    }
}