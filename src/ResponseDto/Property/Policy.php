<?php

namespace egik\TravellineApi\Dto\Property;

class Policy
{
    /**
     * @var string (example 14:00)
     */
    private $checkInTime;

    /**
     * @var string (example 12:00)
     */
    private $checkOutTime;

    /**
     * @return string
     */
    public function getCheckInTime(): string
    {
        return $this->checkInTime;
    }

    /**
     * @return string
     */
    public function getCheckOutTime(): string
    {
        return $this->checkOutTime;
    }
}