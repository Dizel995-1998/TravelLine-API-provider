<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingCancellation
{
    /**
     * @var null|float
     */
    protected $penaltyAmount;

    /**
     * @var string|null
     */
    protected $reason;

    /**
     * @var string
     */
    protected $cancelledUtc;

    /**
     * @return float|null
     */
    public function getPenaltyAmount(): ?float
    {
        return $this->penaltyAmount;
    }

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCancelledUtc(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->cancelledUtc);
    }
}