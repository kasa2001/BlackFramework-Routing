<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class AuthorizationRequired extends RouterException
{
    public function __construct(
        $message = self::AUTHORIZATION_REQUIRED_MESSAGE,
        $code = self::AUTHORIZATION_REQUIRED,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
