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

    /**
     * @return int
     */
    public function getPriceBeforeTax(): int
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
     * @return Tax[]
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }
}