<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class RoomStayService
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var bool
     */
    protected $inclusive;

    /**
     * @var string
     */
    protected $kind;

    /**
     * @var string|null
     */
    protected $mealPlanCode;

    /**
     * @var string|null
     */
    protected $mealPlanName;
}