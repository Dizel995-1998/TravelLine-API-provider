<?php

namespace egik\TravellineApi\RequestDto\Reservation\Verify;

class BookingRatePlan
{
    /**
     * @var string
     */
    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
