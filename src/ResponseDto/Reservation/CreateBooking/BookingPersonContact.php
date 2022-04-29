<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingPersonContact
{
    /**
     * @var BookingPersonPhone[]
     */
    protected $phones;

    /**
     * @var BookingPersonEmail[]
     */
    protected $emails;

    /**
     * @return string[]
     */
    public function getPhones(): array
    {
        $callbackPhonesResolver = (function (BookingPersonPhone $phone) {
            return $phone->getPhoneNumber();
        });

        return array_map($callbackPhonesResolver, $this->phones);
    }

    /**
     * @return string[]
     */
    public function getEmails(): array
    {
        $callbackEmailsResolver = (function (BookingPersonEmail $phone) {
            return $phone->getEmailAddress();
        });

        return array_map($callbackEmailsResolver, $this->emails);
    }
}