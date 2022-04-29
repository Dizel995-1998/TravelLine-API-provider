<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class Content
{
    /**
     * @var RatePlan[]
     */
    private $ratePlans;

    /**
     * @var RoomContentType[]
     */
    private $roomTypes;

    /**
     * @return RatePlan[]
     */
    public function getRatePlans(): array
    {
        return $this->ratePlans;
    }

    /**
     * @return RoomContentType[]
     */
    public function getRoomTypes(): array
    {
        return $this->roomTypes;
    }
}