<?php

namespace egik\TravellineApi\RequestDto\Reservation\CreateBooking;

class Customer
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
     * @var
     */
    protected $middleName;

    /**
     * todo: нужен енам из пхп 8
     * Гражданство.
     * Трезбуквенный код, соответсвует стандарту ISO 3166-1 alpha-3
     * @var string
     */
    protected $citizenShip;

    /**
     * @var BookingPersonContracts
     */
    protected $contracts;

    public function __construct(
        string $firstName,
        string $lastName,
        string $citizenShip,
        BookingPersonContracts $contracts
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->citizenShip = $citizenShip;
        $this->contracts = $contracts;
    }

    public function setMiddleName(string $middleName): void
    {
        $this->middleName = $middleName;
    }
}