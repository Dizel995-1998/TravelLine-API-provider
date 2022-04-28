<?php

namespace egik\TravellineApi\Dto\SpecifiedProperty;

class Address extends \egik\TravellineApi\Dto\Property\Address
{
    /**
     * @var string
     */
    private $remark;

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark;
    }
}