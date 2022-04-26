<?php

namespace egik\TravellineApi\Dto\MealPlan;

class MealPlan
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

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