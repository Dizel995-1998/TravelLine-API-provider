<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class StayDates
{
    /**
     * @var string
     */
    private $arrivalDateTime;

    /**
     * @var string
     */
    private $departureDateTime;

    /**
     * @return string
     */
    public function getArrivalDateTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->arrivalDateTime);
    }

    /**
     * @return string
     */
    public function getDepartureDateTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->departureDateTime);
    }
}