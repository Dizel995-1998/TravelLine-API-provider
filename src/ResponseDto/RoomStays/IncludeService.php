<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class IncludeService
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $mealPlanCode;

    public function getId(): string
    {
        return $this->id;
    }

    public function getMealPlanCode(): ?string
    {
        return $this->mealPlanCode;
    }
}