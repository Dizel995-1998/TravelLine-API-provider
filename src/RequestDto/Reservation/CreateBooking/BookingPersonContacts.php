<?php

namespace egik\TravellineApi\RequestDto\Reservation\CreateBooking;

class BookingPersonContacts implements \JsonSerializable
{
    /**
     * @var string[]
     */
    protected $phones;

    /**
     * @var string[]
     */
    protected $emails;

    /**
     * @param string[] $phones
     * @param string[] $emails
     */
    public function __construct(array $phones, array $emails)
    {
        $this->phones = $phones;
        $this->emails = $emails;
    }

    public function jsonSerialize(): array
    {
        $phones = [];
        $emails = [];

        foreach ($this->phones as $phone) {
            $phones[] = ['phoneNumber' => $phone];
        }

        foreach ($this->emails as $email) {
            $emails[] = ['emailAddress' => $email];
        }

        return [
            'phones' => $phones,
            'emails' => $emails,
        ];
    }
}