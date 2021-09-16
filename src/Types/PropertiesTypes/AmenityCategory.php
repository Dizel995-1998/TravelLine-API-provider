<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 * Категория оснащения номера
 */
class AmenityCategory
{
    /**
     * Индекс категории оснащения
     * @var integer
     */
    public $index;

    /**
     * Название категории
     * @var string
     */
    public $name;

    /**
     * @param array $array
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        try {
            $object->index =  (int) $array['index'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("index is empty");
        }

        try {
            $object->name = $array['name'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("name is empty");
        }

        return $object;
    }


}


