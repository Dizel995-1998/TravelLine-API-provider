<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class BookingRoomType
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var BookingPlacement[]
     */
    protected $placements;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return BookingPlacement[]
     */
    public function getPlacements(): array
    {
        return $this->placements;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
