<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class IncludedService
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $mealPlanCode;

    public function getId(): string
    {
        return $this->id;
    }

    public function getMealPlanCode(): ?string
    {
        return $this->mealPlanCode;
    }
}