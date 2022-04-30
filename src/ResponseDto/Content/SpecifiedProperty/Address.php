<?php

namespace egik\TravellineApi\ResponseDto\Content\SpecifiedProperty;

class Address extends \egik\TravellineApi\ResponseDto\Content\Property\Address
{
    /**
     * @var string
     */
    protected $remark;

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark;
    }
}
