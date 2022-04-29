<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

use egik\TravellineApi\ResponseDto\Search\RoomStays\GuestCount;

class BookingRoomStay
{
    /**
     * @var BookingStayDates
     */
    protected $stayDates;

    /**
     * @var BookingRatePlan
     */
    protected $ratePlan;

    /**
     * @var BookingRoomType
     */
    protected $roomType;

    /**
     * @var null|BookingGuest[]
     */
    protected $guests;

    /**
     * @var GuestCount
     */
    protected $guestCount;

    /**
     * @var string
     */
    protected $checksum;

    /**
     * @var BookingDailyRate[]|null
     */
    protected $dailyRates;

    /**
     * @var BookingTotal
     */
    protected $total;

    /**
     * @var RoomStayService[]|null
     */
    protected $services;
}