<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

class StayDates
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