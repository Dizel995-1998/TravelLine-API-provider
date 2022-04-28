<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class Vat
{
    /**
     * @var bool
     */
    private $applicable;

    /**
     * @var bool
     */
    private $included;

    /**
     * @var int
     */
    private $percent;

    /**
     * @return bool
     */
    public function isApplicable(): bool
    {
        return $this->applicable;
    }

    /**
     * @return bool
     */
    public function isIncluded(): bool
    {
        return $this->included;
    }

    /**
     * @return int
     */
    public function getPercent(): int
    {
        return $this->percent;
    }
}