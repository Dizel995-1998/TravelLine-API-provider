<?php

namespace egik\TravellineApi\Dto\SpecifiedProperty;

class Phone
{
    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $remark;

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