<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class Gone extends RouterException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            self::GONE_MESSAGE,
            self::GONE,
            $previous
        );
    }

}