<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

use egik\TravellineApi\ResponseDto\Search\RoomStays\CancellationPolicy;

class CreatedBookingResult
{
    /**
     * @var string
     */
    protected $propertyId;

    /**
     * @var BookingRoomStay[]
     */
    protected $roomStays;

//    /**
//     * @todo помеченно как заполнированно
//     * @var
//     */
//    protected $services;

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
     * @var string|null
     */
    protected $number;

    /**
     * todo: enum
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $createdDateTime;

    /**
     * @var string
     */
    protected $modifiedDateTime;

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
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedDateTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->createdDateTime);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getModifiedDateTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->modifiedDateTime);
    }
}