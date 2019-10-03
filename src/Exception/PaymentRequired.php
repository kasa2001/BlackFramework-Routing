<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class PaymentRequired extends RouterException
{
    public function __construct(
        $message = self::PAYMENT_REQUIRED_MESSAGE,
        $code = self::PAYMENT_REQUIRED,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

}