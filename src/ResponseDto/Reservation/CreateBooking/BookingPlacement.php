<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingPlacement
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var int
     */
    protected $count;

    /**
     * @var string
     */
    protected $kind;

    /**
     * @var int|null
     */
    protected $minAge;

    /**
     * @var int|null
     */
    protected $maxAge;
}