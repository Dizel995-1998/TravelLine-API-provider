<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class RoomType
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Placement[]
     */
    private $placements;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Placement[]
     */
    public function getPlacements(): array
    {
        return $this->placements;
    }
}