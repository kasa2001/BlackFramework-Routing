<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class Teapot extends RouterException
{
    public function __construct(
        $message = self::IM_A_TEAPOT_MESSAGE,
        $code = self::IM_A_TEAPOT,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

}