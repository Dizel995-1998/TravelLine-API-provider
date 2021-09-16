<?php

namespace  egik\TravellineApi\Types\PropertiesTypes;

use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 *Список средств размещения с подробной информацией по каждому. Список разбит на страницы
 */
class PropertyInfoPage
{
    /**
     * Ключ, для продолжения просмотра списка. null, если текущая страница последня
     * @var string|null
     */
    public $next;

    /**
     * Список средств размещений
     * @var PropertyInfoType[]|null
     */
    public $properties;


    /**
     * @param array $response
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $response): self
    {
        $object = new static();
        $object->next = $response['next'];
        $object->properties = [];
        if(is_array($response['properties'])) {
            foreach ($response['properties'] as $property) {
               $object->properties[] =  PropertyInfoType::createFromArray($property);
            }
        }
        return $object;
    }


}