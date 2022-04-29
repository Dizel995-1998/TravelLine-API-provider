<?php

namespace egik\TravellineApi\RequestDto\Booking;

class CreateBookingDTO
{
    /**
     * @var string
     */
    protected $propertyId;

    protected $roomStays;

    public function __construct(string $propertyId, )
    {
        $this->propertyId = $propertyId;
    }
}