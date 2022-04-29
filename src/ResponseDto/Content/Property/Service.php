<?php

namespace egik\TravellineApi\ResponseDto\Content\Property;

class Service
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
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @return string
     */
    public function getMealPlanCode(): ?string
    {
        return $this->mealPlanCode;
    }

    /**
     * @return string
     */
    public function getMealPlanName(): ?string
    {
        return $this->mealPlanName;
    }
}