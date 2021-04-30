<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class Teapot extends RouterException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            self::IM_A_TEAPOT_MESSAGE,
            self::IM_A_TEAPOT,
            $previous
        );
    }

}