<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class CancellationPolicy
{
    /**
     * @var bool
     */
    private $freeCancellationPossible;

    /**
     * @var string
     */
    private $freeCancellationDeadlineLocal;

    /**
     * @var string
     */
    private $freeCancellationDeadlineUtc;

    /**
     * @var int
     */
    private $penaltyAmount;

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