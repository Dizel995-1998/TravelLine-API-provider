<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class Address extends \egik\TravellineApi\ResponseDto\Property\Address
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