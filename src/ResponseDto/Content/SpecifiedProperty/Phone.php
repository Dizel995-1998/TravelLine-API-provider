<?php

namespace egik\TravellineApi\ResponseDto\Content\SpecifiedProperty;

class Phone
{
    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $remark;

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark;
    }
}
