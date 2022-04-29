<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingRoomType
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var BookingPlacement[]
     */
    protected $placements;

    /**
     * @var string
     */
    protected $name;
}