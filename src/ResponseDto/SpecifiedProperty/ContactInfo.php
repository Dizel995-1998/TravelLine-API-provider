<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class ContactInfo
{
    /**
     * @var Address
     */
    protected $address;

    /**
     * @var Phone[]
     */
    protected $phones;

    /**
     * @var array<int, string>
     */
    protected $emails;

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return Phone[]
     */
    public function getPhones(): array
    {
        return $this->phones;
    }

    /**
     * @return string[]
     */
    public function getEmails(): array
    {
        return $this->emails;
    }
}