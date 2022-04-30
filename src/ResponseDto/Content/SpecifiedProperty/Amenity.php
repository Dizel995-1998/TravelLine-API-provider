<?php

namespace egik\TravellineApi\ResponseDto\Content\SpecifiedProperty;

class Amenity
{
    /**
     * @var int
     */
    protected $amenityCategoryIndex;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return int
     */
    public function getAmenityCategoryIndex(): int
    {
        return $this->amenityCategoryIndex;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
