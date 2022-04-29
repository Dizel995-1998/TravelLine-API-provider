<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class RoomStays
{
    /**
     * @var RoomStay[]
     */
    private $roomStays;

    /**
     * @var Content
     */
    private $content;

    /**
     * @var Warning[]
     */
    private $warnings;

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