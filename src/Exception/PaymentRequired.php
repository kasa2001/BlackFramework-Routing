<?php


namespace BlackFramework\Routing\Exception;


use Throwable;

class PaymentRequired extends RouterException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            self::PAYMENT_REQUIRED_MESSAGE,
            self::PAYMENT_REQUIRED,
            $previous
        );
    }

}