<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class Gone extends RouterException
{
    public function __construct(
        $message = self::GONE_MESSAGE,
        $code = self::GONE,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

}