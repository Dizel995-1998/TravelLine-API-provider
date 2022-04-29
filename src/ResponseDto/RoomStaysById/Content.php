<?php

namespace egik\TravellineApi\ResponseDto\RoomStaysById;

use egik\TravellineApi\ResponseDto\Property\Service;

class Content extends \egik\TravellineApi\ResponseDto\RoomStays\Content
{
    /**
     * @var Service[]
     */
    protected $services;

    /**
     * @return Service[]
     */
    public function getServices(): array
    {
        return $this->services;
    }
}