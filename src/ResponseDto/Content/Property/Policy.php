<?php

namespace egik\TravellineApi\ResponseDto\Content\Property;

class Policy
{
    /**
     * @var string (example 14:00)
     */
    protected $checkInTime;

    /**
     * @var string (example 12:00)
     */
    protected $checkOutTime;

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
