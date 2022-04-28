<?php

namespace egik\TravellineApi\ResponseDto\Property;

class Service
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $kind;

    /**
     * @var string
     */
    private $mealPlanCode;

    /**
     * @var string
     */
    private $mealPlanName;

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
    public function getMealPlanCode(): string
    {
        return $this->mealPlanCode;
    }

    /**
     * @return string
     */
    public function getMealPlanName(): string
    {
        return $this->mealPlanName;
    }
}