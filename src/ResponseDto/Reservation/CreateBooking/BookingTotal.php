<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingTotal
{
    /**
     * @var float
     */
    protected $priceBeforeTax;

    /**
     * @var float
     */
    protected $taxAmount;

    /**
     * @var BookingTaxAmount[]|null
     */
    protected $taxes;
}