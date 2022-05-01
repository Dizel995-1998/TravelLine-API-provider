<?php

namespace egik\TravellineApi\RequestDto\Reservation\Verify;

use JetBrains\PhpStorm\Internal\TentativeType;

class BookingStayDates implements \JsonSerializable
{
    /**
     * @var \DateTimeImmutable
     */
    protected $arrivalDateTime;

    /**
     * @var \DateTimeImmutable
     */
    protected $departureDateTime;

    public function __construct(\DateTimeImmutable $arrivalDateTime, \DateTimeImmutable  $departureDateTime)
    {
        $this->arrivalDateTime = $arrivalDateTime;
        $this->departureDateTime = $departureDateTime;
    }


    public function jsonSerialize(): array
    {
        return [
            'arrivalDateTime' => $this->arrivalDateTime->format('Y-m-d\TH:i'),
            'departureDateTime' => $this->departureDateTime->format('Y-m-d\TH:i'),
        ];
    }
}
