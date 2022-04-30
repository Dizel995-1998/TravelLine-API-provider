<?php

namespace egik\TravellineApi\RequestDto\Reservation\CreateBooking;

// todo: realize services

class CreateBookingRequest implements \JsonSerializable
{
    /**
     * Идентификатор средства размещения
     * @var string
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

    public function __construct(string $propertyId, array $roomStays, Customer $customer, string $createBookingToken)
    {
        $this->propertyId = $propertyId;
        $this->roomStays = $roomStays;
        $this->customer = $customer;
        $this->createBookingToken = $createBookingToken;
    }


    public function jsonSerialize()
    {
        return [
            'booking' => [
                'propertyId' => $this->propertyId,
                'roomStays' => $this->roomStays,
                'customer' => $this->customer,
                'createBookingToken' => $this->createBookingToken,
            ],
        ];
    }
}