<?php


namespace BlackFramework\Routing\Exception;

use Exception;

class RouterException extends Exception
{
    /**
     * Client Errors
     */
    const BAD_REQUEST = 400;
    const AUTHORIZATION_REQUIRED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const GONE = 410;

    /**
     * Easter egg
     */
    const IM_A_TEAPOT = 418;

    /**
     * Server errors
     */
    const INTERNAL_SERVER_ERROR = 500;


    /**
     * Messages
     */
    const BAD_REQUEST_MESSAGE = "Bad Request";
    const AUTHORIZATION_REQUIRED_MESSAGE = "Authorization Required";
    const PAYMENT_REQUIRED_MESSAGE = "Payment Required";
    const FORBIDDEN_MESSAGE = "Forbidden";
    const NOT_FOUND_MESSAGE = "Not Found";
    const GONE_MESSAGE = "Gone";

    /**
     * Easter egg message
     */
    const IM_A_TEAPOT_MESSAGE = "I'm a Teapot";

    /**
     * Server errors message
     */
    const INTERNAL_SERVER_ERROR_MESSAGE = "Internal Server Error";

    /**
     * Previous exception message
     */
    const LACK_OF_QUERY_PARAMETER = "Missing parameter in query";
    const CONFIGURATION_MISSING = "Check your configuration in route array";

}