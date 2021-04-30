<?php


namespace BlackFramework\Routing\Part;

/**
 * The method of sending the request
 */
class Method implements IPart
{
    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getPart(): string
    {
        return $this->type;
    }

}
