<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class BadRequest extends RouterException
{
    public function __construct(
        $message = self::BAD_REQUEST_MESSAGE,
        $code = self::BAD_REQUEST,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

}