<?php

namespace egik\TravellineApi\Exception;

use Exception;
use Throwable;

class TravelLineBadResponseException extends Exception
{
    /**
     * @var int
     */
    private $httpCode;

    public function __construct($message, $httpCode, Throwable $previous = null)
    {
        $this->httpCode = $httpCode;
        parent::__construct($message, 0, $previous);
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }
}
