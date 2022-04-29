<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class RoomType extends \egik\TravellineApi\ResponseDto\Property\RoomType
{
    /**
     * @var string
     */
    protected $categoryCode;

    /**
     * @var string
     */
    protected $categoryName;

    /**
     * @var Amenity[]
     */
    protected $amenities;

    /**
     * @return string
     */
    public function getCategoryCode(): string
    {
        return $this->categoryCode;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @return Amenity[]
     */
    public function getAmenities(): array
    {
        return $this->amenities;
    }
}