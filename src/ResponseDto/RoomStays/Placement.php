<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class Placement
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var int
     */
    private $count;

    /**
     * @var string
     */
    private $kind;

    /**
     * @var int|null
     */
    private $minAge;

    /**
     * @var int|null
     */
    private $maxAge;
}