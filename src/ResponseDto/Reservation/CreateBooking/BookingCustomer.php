<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingCustomer
{
    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string|null
     */
    protected $middleName;

    /**
     * @var string
     */
    protected $citizenship;

    /**
     * @var BookingPersonContact
     */
    protected $contacts;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @return string
     */
    public function getCitizenship(): string
    {
        return $this->citizenship;
    }

    /**
     * @return BookingPersonContact
     */
    public function getContacts(): BookingPersonContact
    {
        return $this->contacts;
    }
}
