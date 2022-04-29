<?php

namespace egik\TravellineApi\RequestDto\Reservation\Booking;

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