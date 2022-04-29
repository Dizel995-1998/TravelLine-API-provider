<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingGuestCount
{
    /**
     * @var int
     */
    protected $adultCount;

    /**
     * @var null|int[]
     */
    protected $childAges;
}