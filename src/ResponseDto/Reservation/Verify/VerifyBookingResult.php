<?php

namespace egik\TravellineApi\ResponseDto\Reservation\Verify;

use egik\TravellineApi\ResponseDto\Search\RoomStays\Warning;
use Symfony\Component\Validator\Constraints as Assert;

class VerifyBookingResult
{
    /**
     * @Assert\Valid()
     * @var VerifyBooking
     */
    protected $booking;

    /**
     * @var null|VerifyBooking
     */
    protected $alternativeBooking = null;

    /**
     * @var null|Warning[]
     */
    protected $warnings = null;

    /**
     * @return VerifyBooking
     */
    public function getBooking(): VerifyBooking
    {
        return $this->booking;
    }

    /**
     * @return VerifyBooking|null
     */
    public function getAlternativeBooking(): ?VerifyBooking
    {
        return $this->alternativeBooking;
    }

    /**
     * @return Warning[]|null
     */
    public function getWarnings(): ?array
    {
        return $this->warnings;
    }
}