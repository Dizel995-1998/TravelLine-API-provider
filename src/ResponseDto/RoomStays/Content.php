<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class Content
{
    /**
     * @var RatePlan[]
     */
    protected $ratePlans;

    /**
     * @var RoomContentType[]
     */
    protected $roomTypes;

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