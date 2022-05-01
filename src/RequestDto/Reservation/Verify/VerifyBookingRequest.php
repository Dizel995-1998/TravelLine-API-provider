<?php

namespace egik\TravellineApi\RequestDto\Reservation\Verify;

use egik\TravellineApi\RequestDto\Reservation\CreateBooking\Customer;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingRoomStay;
use  egik\TravellineApi\RequestDto\Reservation\Verify\BookingRoomStay as RequestBookingRoomStay;

class VerifyBookingRequest implements \JsonSerializable
{
    /**
     * @var string
     */
    protected $propertyId;

    /**
     * @var BookingRoomStay[]
     */
    protected $roomStays;

    /**
     * @var Customer
     */
    protected $customer;

    public function __construct(string $propertyId, Customer $customer, RequestBookingRoomStay ...$roomStays)
    {
        $this->propertyId = $propertyId;
        $this->roomStays = $roomStays;
        $this->customer = $customer;
    }

    public function addService(): void
    {
    }


    public function jsonSerialize()
    {
        return [
            'booking' => [
                'propertyId' => $this->propertyId,
                'roomStays' => $this->roomStays,
//                'services' => $this->services, // todo: realize,
                'customer' => $this->customer,
            ]
        ];
    }
}
