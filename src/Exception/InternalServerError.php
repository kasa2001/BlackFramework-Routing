<?php


namespace BlackFramework\Routing\Exception;

use Throwable;

class InternalServerError extends RouterException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            self::INTERNAL_SERVER_ERROR_MESSAGE,
            self::INTERNAL_SERVER_ERROR,
            $previous
        );
    }

}