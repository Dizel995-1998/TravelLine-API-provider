<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

class RoomStays
{
    /**
     * @var RoomStay[]|null
     */
    protected $roomStays;

    /**
     * @var Content|null
     */
    protected $content;

    /**
     * @var Warning[]|null
     */
    protected $warnings;

    /**
     * @return RoomStay[]|null
     */
    public function getRoomStays(): ?array
    {
        return $this->roomStays;
    }

    /**
     * @return Content|null
     */
    public function getContent(): ?Content
    {
        return $this->content;
    }

    /**
     * @return Warning[]|null
     */
    public function getWarnings(): ?array
    {
        return $this->warnings;
    }
}
