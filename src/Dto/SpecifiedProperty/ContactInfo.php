<?php

namespace egik\TravellineApi\Dto\SpecifiedProperty;

class ContactInfo
{
    /**
     * @var Address
     */
    private $address;

    /**
     * @var Phone[]
     */
    private $phones;

    /**
     * @var array<int, string>
     */
    private $emails;

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