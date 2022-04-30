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

    /**
     * @return BookingStayDates
     */
    public function getStayDates(): BookingStayDates
    {
        return $this->stayDates;
    }

    /**
     * @return BookingRatePlan
     */
    public function getRatePlan(): BookingRatePlan
    {
        return $this->ratePlan;
    }

    /**
     * @return BookingRoomType
     */
    public function getRoomType(): BookingRoomType
    {
        return $this->roomType;
    }

    /**
     * @return BookingGuest[]|null
     */
    public function getGuests(): ?array
    {
        return $this->guests;
    }

    /**
     * @return GuestCount
     */
    public function getGuestCount(): GuestCount
    {
        return $this->guestCount;
    }

    /**
     * @return string
     */
    public function getChecksum(): string
    {
        return $this->checksum;
    }

    /**
     * @return BookingDailyRate[]|null
     */
    public function getDailyRates(): ?array
    {
        return $this->dailyRates;
    }

    /**
     * @return BookingTotal
     */
    public function getTotal(): BookingTotal
    {
        return $this->total;
    }

    /**
     * @return RoomStayService[]|null
     */
    public function getServices(): ?array
    {
        return $this->services;
    }
}
