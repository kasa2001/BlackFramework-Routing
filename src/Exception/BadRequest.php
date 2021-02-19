<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class BadRequest extends RouterException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            self::BAD_REQUEST_MESSAGE,
            self::BAD_REQUEST,
            $previous
        );
    }

}