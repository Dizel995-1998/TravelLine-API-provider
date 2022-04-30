<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

class CancellationPolicy
{
    /**
     * @var bool
     */
    protected $freeCancellationPossible;

    /**
     * @var string
     */
    protected $freeCancellationDeadlineLocal;

    /**
     * @var string
     */
    protected $freeCancellationDeadlineUtc;

    /**
     * @var int
     */
    protected $penaltyAmount;

    public function isFreeCancellationPossible(): bool
    {
        return $this->freeCancellationPossible;
    }

    public function getFreeCancellationDeadlineLocal(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->freeCancellationDeadlineLocal);
    }

    public function getFreeCancellationDeadlineUtc(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->freeCancellationDeadlineUtc);
    }

    public function getPenaltyAmount(): int
    {
        return $this->penaltyAmount;
    }
}
