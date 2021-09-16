<?php


namespace  egik\TravellineApi\Types\PropertyEventTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;
/**
 *События, произошедшие со средствами размещения
 */
class PropertyEvents
{
    /**
     * Список событий, произошедших со средтством размещения
     * @var PropertyEvent[]|null
     */
    public $events;

    /**
     * Токен на продолжения чтения событий
     * @var string|null
     */
    public $continuousToken;

    /**
     * Идентификатор средства размещения
     * @var bool
     */
    public $hasMoreData;

    /**
     * @param array $response
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $response): self
    {
        $object = new static();
        $object->events = [];
        if(is_array($response['events'])) {
            foreach ($response['events'] as $event) {
                $object->events[] =  PropertyEvent::createFromArray($event);
            }
        }

        try {
            $object->continuousToken = $response['continuousToken'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("continuousToken is empty");
        }

        try {
            $object->hasMoreData = $response['hasMoreData'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("hasMoreData is empty");
        }

        return $object;
    }


}


