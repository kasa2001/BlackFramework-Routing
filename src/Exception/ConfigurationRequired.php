<?php


namespace BlackFramework\Routing\Exception;

use Exception;
use Throwable;

class ConfigurationRequired extends Exception
{

    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            RouterException::CONFIGURATION_MISSING,
            RouterException::NOT_FOUND,
            $previous
        );
    }

}