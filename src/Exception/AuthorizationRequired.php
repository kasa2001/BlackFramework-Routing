<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class AuthorizationRequired extends RouterException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            self::AUTHORIZATION_REQUIRED_MESSAGE,
            self::AUTHORIZATION_REQUIRED,
            $previous
        );
    }

}
