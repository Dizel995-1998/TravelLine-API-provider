<?php

namespace egik\TravellineApi\ResponseDto\Reservation\Verify;

use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingCancellation;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingCustomer;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingRoomStay;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingTax;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingTotal;
use egik\TravellineApi\ResponseDto\Search\RoomStays\CancellationPolicy;
use egik\TravellineApi\ResponseDto\Search\RoomStays\Tax;

/**
 * todo: добавить валидацию через Assert'ы
 */
class VerifyBooking
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
     * todo: помеченно как запланированный функционал, посмотреть что в JSON'e
     */
    protected $services;

    /**
     * @var BookingCustomer
     */
    protected $customer;

    /**
     * @var BookingTotal
     */
    protected $total;

    /**
     * @var BookingTax[]
     */
    protected $taxes;

    /**
     * @var string|null
     */
    protected $currencyCode;

    /**
     * @var BookingCancellation
     */
    protected $cancellation;

    /**
     * @var CancellationPolicy
     */
    protected $cancellationPolicy;

    /**
     * @var string
     */
    protected $createBookingToken;

    /**
     * @return string
     */
    public function getPropertyId(): string
    {
        return $this->propertyId;
    }

    /**
     * @return BookingRoomStay[]
     */
    public function getRoomStays(): array
    {
        return $this->roomStays;
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @return BookingCustomer
     */
    public function getCustomer(): BookingCustomer
    {
        return $this->customer;
    }

    /**
     * @return BookingTotal
     */
    public function getTotal(): BookingTotal
    {
        return $this->total;
    }

    /**
     * @return BookingTax[]
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }

    /**
     * @return string|null
     */
    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    /**
     * @return BookingCancellation
     */
    public function getCancellation(): BookingCancellation
    {
        return $this->cancellation;
    }

    /**
     * @return CancellationPolicy
     */
    public function getCancellationPolicy(): CancellationPolicy
    {
        return $this->cancellationPolicy;
    }

    /**
     * @return string
     */
    public function getCreateBookingToken(): string
    {
        return $this->createBookingToken;
    }
}