<?php

namespace egik\TravellineApi\ResponseDto\Content\Property;

class RoomSize
{
    /**
     * @var int
     */
    protected $value;

    /**
     * @var string
     */
    protected $unit;

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
