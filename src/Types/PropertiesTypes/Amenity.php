<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

/**
 * Оснащение номера
 */
class Amenity
{
    /**
     * Индекс категории оснащения
     * @var integer
     */
    public $amenityCategoryIndex;

    /**
     * Код удобства
     * @var string
     */
    public $code;

    /**
     * Название удобства
     * @var string
     */
    public $name;


    /**
     * @param array $array
     * @return self
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        $object->amenityCategoryIndex = $array['amenityCategoryIndex'];
        $object->code = $array['code'];
        $object->name = $array['name'];
        return $object;
    }


}


