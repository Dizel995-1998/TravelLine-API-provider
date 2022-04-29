<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingStayDates
{
    /**
     * @var string
     */
    protected $arrivalDateTime;

    /**
     * @var string
     */
    protected $departureDateTime;

    /**
     * @return \DateTimeImmutable
     */
    public function getArrivalDateTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->arrivalDateTime);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDepartureDateTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->departureDateTime);
    }
}