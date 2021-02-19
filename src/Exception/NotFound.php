<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class NotFound extends RouterException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            self::NOT_FOUND_MESSAGE,
            self::NOT_FOUND,
            $previous
        );
    }

}