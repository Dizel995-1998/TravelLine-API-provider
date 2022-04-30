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

    /**
     * @return float
     */
    public function getPriceBeforeTax(): float
    {
        return $this->priceBeforeTax;
    }

    /**
     * @return float
     */
    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    /**
     * @return BookingTaxAmount[]|null
     */
    public function getTaxes(): ?array
    {
        return $this->taxes;
    }
}
