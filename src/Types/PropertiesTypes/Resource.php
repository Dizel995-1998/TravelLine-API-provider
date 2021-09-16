<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 * Информация о ресурсе
 */
class Resource
{
    /**
     * Ссылка на ресурс
     * @var string
     */
    public $url;


    /**
     * @param array $array
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        try {
            $object->url = $array['url'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("url is empty");
        }

        return $object;
    }


}