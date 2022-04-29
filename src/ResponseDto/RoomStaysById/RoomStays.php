<?php

namespace egik\TravellineApi\ResponseDto\RoomStaysById;

use egik\TravellineApi\ResponseDto\RoomStays\RoomStay;

class RoomStays
{
    /**
     * @var RoomStay[]
     */
    protected $roomStays;

    /**
     * @var Content
     */
    protected $content;

    /**
     * @return RoomStay[]
     */
    public function getRoomStays(): array
    {
        return $this->roomStays;
    }

    /**
     * @return Content
     */
    public function getContent(): Content
    {
        return $this->content;
    }
}