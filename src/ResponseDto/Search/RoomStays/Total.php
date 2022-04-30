<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

class Total
{
    /**
     * @var int
     */
    protected $priceBeforeTax;

    /**
     * @var float
     */
    protected $taxAmount;

    /**
     * @var Tax[]
     */
    protected $taxes;

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
