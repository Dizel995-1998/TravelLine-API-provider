<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 * Детальная информация о средстве размещения
 */
class PropertyInfoType
{
    /**
     * Идентификатор средства размещения
     * @var string
     */
    public $id;

    /**
     * Название средства размещения
     * @var string
     */
    public $name;

    /**
     * Подробное описание средства размещения
     * @var string|null
     */
    public $description;

    /**
     * Изображения средства размещения
     * @var Resource[]|null
     */
    public $images;

    /**
     * Звездность средства размещения
     * @var integer|null
     */
    public $stars;

    /**
     * Контактная информация средства размещения
     * @var ContactInfo
     */
    public $contactInfo;

    /**
     * Стандартное время заезда и выезда
     * @var PolicyInfo
     */
    public $policy;

    /**
     * Временная зона средства размещения
     * @var TimeZoneInfo|null
     */
    public $timeZone;

    /**
     * Тарифные планы средства размещения
     * @var RatePlanInfo[]
     */
    public $ratePlans;

    /**
     * Категории номеров средства размещения
     * @var RoomTypeInfo[]
     */
    public $roomTypes;

    /**
     * Категории номеров средства размещения
     * @var ServiceInfo[]
     */
    public $services;

    /**
     * Доступные категории оснащений
     * @var AmenityCategory[]|null
     */
    public $amenityCategories;


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
        $object->stars = $array['stars'] ?? null;

        $object->images = [];
        if(array_key_exists('images', $array) and is_array($array['images'])) {
            foreach ($array['images'] as $image) {
                $object->images[] = Resource::createFromArray($image);
            }
        }

         if(array_key_exists('contactInfo', $array)) {
             $object->contactInfo = ContactInfo::createFromArray($array['contactInfo']);
         }else{
             throw new TravellineInvalidValue("contactInfo is empty");
         }

        if(array_key_exists('policy', $array)) {
            $object->policy = PolicyInfo::createFromArray($array['policy']);
        }else{
            throw new TravellineInvalidValue("policy is empty");
        }

        if(array_key_exists('timeZone', $array) and is_array($array['timeZone'])) {
            $object->timeZone = TimeZoneInfo::createFromArray($array['timeZone']);
        }

        $object->ratePlans = [];
        if( array_key_exists('ratePlans', $array) and is_array($array['ratePlans'])) {
            foreach ($array['ratePlans'] as $ratePlan) {
                $object->ratePlans[] = RatePlanInfo::createFromArray($ratePlan);
            }
        }else{
            throw new TravellineInvalidValue("ratePlans is empty");
        }

        if(array_key_exists('roomTypes', $array) and is_array($array['roomTypes'])) {
            foreach ($array['roomTypes'] as $roomType) {
                $object->roomTypes[] = RoomTypeInfo::createFromArray($roomType);
            }
        }else{
            throw new TravellineInvalidValue("roomTypes is empty");
        }

        $object->services = [];
        if(array_key_exists('services', $array) and is_array($array['services'])) {
            foreach ($array['services'] as $service) {
                $object->services[] = ServiceInfo::createFromArray($service);
            }
        }else{
            throw new TravellineInvalidValue("services is empty");
        }

        $object->amenityCategories = [];
        if(array_key_exists('amenityCategories', $array) and  is_array($array['amenityCategories'])) {
            foreach ($array['amenityCategories'] as $category) {
                $object->amenityCategories[] = AmenityCategory::createFromArray($category);
            }
        }

        return $object;
    }


}
