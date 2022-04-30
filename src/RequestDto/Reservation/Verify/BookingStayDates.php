<?php

namespace egik\TravellineApi\RequestDto\Reservation\Verify;

class BookingStayDates
{
    /**
     * @var \DateTimeImmutable
     */
    protected $arrivalDateTime;

    /**
     * @var \DateTimeImmutable
     */
    protected $departureDateTime;

    public function __construct(\DateTimeImmutable $arrivalDateTime, \DateTimeImmutable  $departureDateTime)
    {
        $this->arrivalDateTime = $arrivalDateTime;
        $this->departureDateTime = $departureDateTime;
    }
}