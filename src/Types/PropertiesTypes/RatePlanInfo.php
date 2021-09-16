<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;
/**
 * Тарифный план средства размещения
 */
class RatePlanInfo
{
    /**
     * Идентификатор тарифного плана
     * @var string
     */
    public $id;

    /**
     * Название тарифного плана
     * @var string
     */
    public $name;

    /**
     * Описание тарифного плана, может содержать html-теги
     * @var string|null
     */
    public $description;

    /**
     * Краткое описание тарифного плана
     * @var string|null
     */
    public $shortDescription;

    /**
     * Валюта тарифного плана
     * @var string
     */
    public $currency;

    /**
     * Список идентификаторов услуг, включенных в стоимость
     * @var string[]|null
     */
    public $includedServicesIds;

    /**
     * Описание НДС
     * @var Vat|null
     */
    public $vat;

    /**
     * @param array $array
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        try {
            $object->id = $array['id'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("id is empty");
        }

        try {
            $object->name = $array['name'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("name is empty");
        }

        $object->description = $array['description'] ?? null;
        $object->shortDescription = $array['shortDescription'] ?? null;

        try {
            $object->currency = $array['currency'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("currency is empty");
        }

        $object->includedServicesIds = $array['includedServicesIds'] ?? null;
        if(array_key_exists('vat', $array) and is_array($array['vat'])) {
            $object->vat = Vat::createFromArray($array['vat']);
        }
        return $object;
    }


}
