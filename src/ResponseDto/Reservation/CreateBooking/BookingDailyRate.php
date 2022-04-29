<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

use DateTimeImmutable;

class BookingDailyRate
{
    /**
     * @var int
     */
    protected $priceBeforeTax;

    /**
     * @var string
     */
    protected $date;

    /**
     * @return int
     */
    public function getPriceBeforeTax(): int
    {
        return $this->priceBeforeTax;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->date);
    }
}