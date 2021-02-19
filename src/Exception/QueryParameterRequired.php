<?php


namespace BlackFramework\Routing\Exception;

use Exception;
use Throwable;

class QueryParameterRequired extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            RouterException::LACK_OF_QUERY_PARAMETER,
            RouterException::BAD_REQUEST,
            $previous
        );
    }

}