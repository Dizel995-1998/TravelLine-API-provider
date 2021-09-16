<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 * Стандартное время заезда и выезда
 */
class PolicyInfo
{
    /**
     * Локальное время заезда в средство размещения. Формат соответсвует ISO-8601 hh:mm
     * @var string
     */
    public $checkInTime;

    /**
     * Локальное время выезда из средства размещения.
     * @var string
     */
    public $checkOutTime;


    /**
     * @param array $array
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        try {
            $object->checkInTime = $array['checkInTime'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("checkInTime is empty");
        }
        try {
            $object->checkOutTime = $array['checkOutTime'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("checkOutTime is empty");
        }
        return $object;
    }


}