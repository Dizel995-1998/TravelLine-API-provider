<?php

namespace egik\TravellineApi\RequestDto\Reservation\CreateBooking;

// todo: realize services
class CreateBookingRequest
{
    /**
     * Идентификатор средства размещения
     * @var int
     */
    protected $propertyId;

    /**
     * Список проживаний
     * @var array
     */
    protected $roomStays;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var string
     */
    protected $createBookingToken;

    public function __construct(int $propertyId, array $roomStays, Customer $customer, string $createBookingToken)
    {
        $this->propertyId = $propertyId;
        $this->roomStays = $roomStays;
        $this->customer = $customer;
        $this->createBookingToken = $createBookingToken;
    }
}