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
}