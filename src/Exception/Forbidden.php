<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class Forbidden extends RouterException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            self::FORBIDDEN_MESSAGE,
            self::FORBIDDEN,
            $previous
        );
    }

}