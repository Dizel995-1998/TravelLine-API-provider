<?php

namespace egik\TravellineApi\Exception;


use Throwable;

class TravelLineInvalidResponseException extends \RuntimeException
{
    protected $validationErrors;

    /**
     * @param string|array $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($validationErrors = "", int $code = 0, Throwable $previous = null)
    {
        $this->validationErrors = is_string($validationErrors) ? [$validationErrors] : $validationErrors;
        parent::__construct(current($validationErrors), $code, $previous);
    }

    /**
     * @return string[]
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}