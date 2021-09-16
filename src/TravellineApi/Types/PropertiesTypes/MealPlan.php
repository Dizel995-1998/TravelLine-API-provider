<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

/**
 * Описание питания
 */
class MealPlan
{
    /**
     * Код питания
     * @var string|null
     */
    public $code;

    /**
     * Название питания
     * @var string|null
     */
    public $name;

    /**
     * @param array $array
     * @return self
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        $object->code = $array['code'] ?? null;
        $object->name = $array['name'] ?? null;
        return $object;
    }


}