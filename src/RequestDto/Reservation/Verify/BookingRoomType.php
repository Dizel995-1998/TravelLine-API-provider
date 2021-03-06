<?php

namespace egik\TravellineApi\RequestDto\Reservation\Verify;

use Symfony\Component\Validator\Constraints as Assert;

class BookingRoomType
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @var BookingPlacement[]
     */
    protected $placements;

    public function __construct(int $id, BookingPlacement ...$placements)
    {
        if (empty($placements)) {
            throw new \InvalidArgumentException('Placements is required argument');
        }

        $this->id = $id;
        $this->placements = $placements;
    }
}
