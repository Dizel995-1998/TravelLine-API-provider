<?php

namespace egik\TravellineApi\RequestDto\Reservation\Verify;

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
     * @var BookingGuestCount
     */
    protected $guestCount;

    /**
     * @var string
     */
    protected $checksum;

    // todo: where is BookingGuest?
    public function __construct(
        BookingStayDates $stayDates,
        BookingRatePlan $ratePlan,
        BookingRoomType $roomType,
        BookingGuestCount $guestCount,
        string $checksum
    ) {
       $this->stayDates = $stayDates;
       $this->ratePlan = $ratePlan;
       $this->roomType = $roomType;
       $this->guestCount = $guestCount;
       $this->checksum = $checksum;
    }

    /**
     * todo: realize
     */
    public function addService(): void
    {

    }
}