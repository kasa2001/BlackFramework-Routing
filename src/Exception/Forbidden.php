<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class Forbidden extends RouterException
{
    public function __construct(
        $message = self::FORBIDDEN_MESSAGE,
        $code = self::FORBIDDEN,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

}