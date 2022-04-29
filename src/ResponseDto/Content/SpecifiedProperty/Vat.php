<?php

namespace egik\TravellineApi\ResponseDto\Content\SpecifiedProperty;

class Vat
{
    /**
     * @var bool
     */
    protected $applicable;

    /**
     * @var bool
     */
    protected $included;

    /**
     * @var int
     */
    protected $percent;

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