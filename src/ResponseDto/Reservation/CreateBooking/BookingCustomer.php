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
     * @var BookingPersonContract[]
     */
    protected $contracts;
}