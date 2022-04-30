<?php

namespace egik\TravellineApi\RequestDto\Reservation\Verify;

class BookingPlacement
{
    /**
     * @var string
     */
    protected $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }
}