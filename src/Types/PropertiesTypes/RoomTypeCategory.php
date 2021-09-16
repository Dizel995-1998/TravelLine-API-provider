<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

/**
 * Информация по типу номера
 */
class RoomTypeCategory
{
    /**
     * Код
     * @var string|null
     */
    public $code;

    /**
     * Название
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