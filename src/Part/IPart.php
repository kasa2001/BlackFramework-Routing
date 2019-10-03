<?php


namespace BlackFramework\Routing\Part;


interface IPart
{
    /**
     * Method check part of Request
     * @param IPart $part
     * @return bool
     */
    public function checkPart(IPart $part): bool;

    /**
     * @return mixed
     */
    public function getPart();
}