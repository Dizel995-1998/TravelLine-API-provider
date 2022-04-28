<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class Total
{
    /**
     * @var int
     */
    private $priceBeforeTax;

    /**
     * @var float
     */
    private $taxAmount;

    /**
     * @var Tax[]
     */
    private $taxes;
}