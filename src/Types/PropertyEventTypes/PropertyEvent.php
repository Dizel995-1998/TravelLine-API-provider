<?php

namespace egik\TravellineApi\Types\PropertyEventTypes;

use DateTime;
use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 *   Событие, произошедшее со средством размещения
 */
class PropertyEvent
{
    /**
     * Время по UTC, когда событие произошло. Формат соответсвует ISO-8601 YYYY-MM-DDThh:mm:ss
     * @var DateTime
     */
    public $created;


    /**
     * Идентификатор средства размещения
     * @var string
     */
    public $propertyId;



    /**
     * Название события
     * @var PropertyEventType::ADDED | PropertyEventType::MODIFIED
     */
    public $eventType;


    /**
     * @param array $array
     * @return self
     * @throws TravellineInvalidValue
     */

    public static function createFromArray(array $array): self
    {
        $object = new static();
        try {
            $object->created = DateTime::createFromFormat(DateTime::ISO8601, $array['created']);
        } catch (Exception $e) {
            throw new TravellineInvalidValue("created is empty or bad format");
        }

        try {
            $object->propertyId = $array['propertyId'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("propertyId is empty");
        }

        if(array_key_exists("eventType", $array)) {
            $eventType = $array['eventType'];
        }else{
            throw new TravellineInvalidValue("eventType no set");
        }

        if($eventType === PropertyEventType::ADDED) {
            $object->eventType = PropertyEventType::ADDED;
        }elseif($eventType === PropertyEventType::MODIFIED) {
            $object->eventType = PropertyEventType::MODIFIED;
        }else{
            throw new TravellineInvalidValue("Invalid event type ".$eventType);
        }

        return $object;
    }


}


