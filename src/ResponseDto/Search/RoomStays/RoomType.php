<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

class RoomType
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var Placement[]
     */
    protected $placements;

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