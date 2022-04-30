<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

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
     * @var Warning[]
     */
    protected $warnings;

    public function getRoomStays(): array
    {
        return $this->roomStays;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getWarnings(): array
    {
        return $this->warnings;
    }
}
