<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;
/**
 * Площадь номера
 */
class RoomTypeSquare
{
    /**
     * Площадь, значение в квадратных метрах
     * @var integer
     */
    public $value;


    /**
     * @param array $array
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        try {
            $object->value = (int) $array['value'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("value is empty");
        }

        return $object;
    }


}