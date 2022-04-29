<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

class GuestCount
{
    /**
     * @var int
     */
    protected $adultCount;

    /**
     * @var int[]
     */
    protected $childAges;

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