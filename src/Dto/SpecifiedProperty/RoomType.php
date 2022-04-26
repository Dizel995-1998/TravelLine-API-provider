<?php

namespace egik\TravellineApi\Dto\SpecifiedProperty;

class RoomType extends \egik\TravellineApi\Dto\Property\RoomType
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