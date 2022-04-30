<?php

namespace egik\TravellineApi\RequestDto\Reservation\Verify;

class BookingGuestCount
{
    /**
     * @var int
     */
    protected $adultCount;

    /**
     * @var int[]|null
     */
    protected $childAges;

    public function __construct(int $adultCount, int ...$childAges)
    {
        $this->adultCount = $adultCount;
        $this->childAges = $childAges ?: null;
    }
}
