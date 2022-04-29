<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingPersonPhone
{
    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}