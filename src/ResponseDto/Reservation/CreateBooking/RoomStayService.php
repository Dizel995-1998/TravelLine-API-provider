<?php

namespace egik\TravellineApi\ResponseDto\Reservation\CreateBooking;

class RoomStayService
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var bool
     */
    protected $inclusive;

    /**
     * @var string
     */
    protected $kind;

    /**
     * @var string|null
     */
    protected $mealPlanCode;

    /**
     * @var string|null
     */
    protected $mealPlanName;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return bool
     */
    public function isInclusive(): bool
    {
        return $this->inclusive;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @return string|null
     */
    public function getMealPlanCode(): ?string
    {
        return $this->mealPlanCode;
    }

    /**
     * @return string|null
     */
    public function getMealPlanName(): ?string
    {
        return $this->mealPlanName;
    }
}
