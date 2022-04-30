<?php

namespace egik\TravellineApi\RequestDto\Reservation\Verify;

class BookingStayDates
{
    protected $arrivalDateTime;

    protected $departureDateTime;

    public function __construct(\DateTimeImmutable $arrivalDateTime, \DateTimeImmutable  $departureDateTime)
    {
        $this->arrivalDateTime = $arrivalDateTime;
        $this->departureDateTime = $departureDateTime;
    }


}