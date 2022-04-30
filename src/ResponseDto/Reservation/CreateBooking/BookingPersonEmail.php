<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingPersonEmail
{
    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }
}
