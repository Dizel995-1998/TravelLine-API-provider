<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 * Категория номера средства размещения
 */
class RoomTypeInfo
{
    /**
     * Идентификатор категории номера
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
     * Оснащение номера
     * @var Amenity[]|null
     */
    public $amenities;

    /**
     * Изображения номера
     * @var Resource[]|null
     */
    public $images;

    /**
     * Площадь номера
     * @var RoomTypeSquare|null
     */
    public $size;

    /**
     * Код типа номера
     * @var string
     */
    public $categoryCode;

    /**
     * Название типа номера
     * @var string
     */
    public $categoryName;

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

        $object->amenities = [];
        if(array_key_exists('amenities', $array) and is_array($array['amenities'])) {
            foreach ($array['amenities'] as $amenity) {
                $object->amenities[] =  Amenity::createFromArray($amenity);
            }
        }

        $object->images = [];
        if(array_key_exists('images', $array) and  is_array($array['images'])) {
            foreach ($array['images'] as $image) {
                $object->images[] =  Resource::createFromArray($image);
            }
        }

        if(array_key_exists('size', $array)) {
            $object->size = RoomTypeSquare::createFromArray($array['size']);
        }

        try {
            $object->categoryCode = $array['categoryCode'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("categoryCode is empty");
        }

        try {
            $object->categoryName = $array['categoryName'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("categoryName is empty");
        }
        return $object;
    }


}