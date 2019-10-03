<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class NotFound extends RouterException
{
    public function __construct(
        $message = self::NOT_FOUND_MESSAGE,
        $code = self::NOT_FOUND,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}