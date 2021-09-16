<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 * Адрес средства размещения
 */
class Address
{
    /**
     * Почтовый индекс
     * @var string|null
     */
    public $postalCode;

    /**
     * Код страны. Соответствует трехбувеккому страндарту ISO 3166-1 Alpha3
     * @var string
     */
    public $countryCode;

    /**
     * Регион
     * @var string|null
     */
    public $region;

    /**
     * Название города
     * @var string|null
     */
    public $cityName;

    /**
     * Адрес средства размещения с указанием улицы и номера дома
     * @var string|null
     */
    public $addressLine;

    /**
     * Географическая широта
     * @var string|null
     */
    public $latitude;

    /**
     * Географическая долгота
     * @var string|null
     */
    public $longitude;

    /**
     * Доп. информация как добраться
     * @var string|null
     */
    public $remark;

    /**
     * @param array $array
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        $object->postalCode = $array['postalCode'] ?? null;
        try {
            $object->countryCode = $array['countryCode'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("countryCode is empty");
        }
        
        $object->region = $array['region'] ?? null;
        $object->cityName = $array['cityName'] ?? null;
        $object->addressLine = $array['addressLine'] ?? null;
        $object->latitude = $array['latitude'] ?? null;
        $object->longitude = $array['longitude'] ?? null;
        $object->remark = $array['remark'] ?? null;
        return $object;
    }


}


