<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class RoomType extends \egik\TravellineApi\ResponseDto\Property\RoomType
{
    /**
     * @var string
     */
    private $categoryCode;

    /**
     * @var string
     */
    private $categoryName;

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
}