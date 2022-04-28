<?php

namespace egik\TravellineApi\ResponseDto\Property;

class RoomSize
{
    /**
     * @var int
     */
    private $value;

    /**
     * @var string
     */
    private $unit;

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}