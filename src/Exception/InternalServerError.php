<?php


namespace BlackFramework\Routing\Exception;

use Throwable;

class InternalServerError extends RouterException
{
    public function __construct(
        $message = self::INTERNAL_SERVER_ERROR_MESSAGE,
        $code = self::INTERNAL_SERVER_ERROR,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}