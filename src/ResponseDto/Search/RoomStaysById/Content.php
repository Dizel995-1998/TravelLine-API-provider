<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStaysById;

use egik\TravellineApi\ResponseDto\Content\Property\Service;

class Content extends \egik\TravellineApi\ResponseDto\Search\RoomStays\Content
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
