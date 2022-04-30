<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingTaxAmount
{
    /**
     * @var float
     */
    protected $amount;

    /**
     * @var integer
     */
    protected $index;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }
}
