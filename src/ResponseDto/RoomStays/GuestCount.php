<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class GuestCount
{
    /**
     * @var int
     */
    private $adultCount;

    /**
     * @var int[]
     */
    private $childAges;

    /**
     * @return int
     */
    public function getAdultCount(): int
    {
        return $this->adultCount;
    }

    /**
     * @return int[]
     */
    public function getChildAges(): array
    {
        return $this->childAges;
    }
}