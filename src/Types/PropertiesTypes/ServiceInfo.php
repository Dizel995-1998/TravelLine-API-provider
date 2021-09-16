<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;
/**
 * Описание услуги, предоставляемой средством размещения. Если kind=Meal, то в поле mealPlanCode указывается код питания, иначе mealPlanCode=null
 */
class ServiceInfo
{
    /**
     * Идентификатор услуги
     * @var string
     */
    public $id;

    /**
     * Название услуги
     * @var string
     */
    public $name;

    /**
     * Описание услуги
     * @var string|null
     */
    public $description;

    /**
     * Краткое описание тарифного плана
     * @var ServiceKind::COMMON | ServiceKind::MEAL
     */
    public $kind;

    /**
     * Код питания. Указывается, если тип услуги "Питание" (Kind = Meal)
     * @var string|null
     */
    public $mealPlanCode;

    /**
     * Название питания. Указывается, если тип услуги "Питание" (Kind = Meal)
     * @var string|null
     */
    public $mealPlanName;

    /**
     * Массив изображений, предоставляемой услуги
     * @var Resource[]|null
     */
    public $images;

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

        $kind = $array['kind'] ?? null;
        if($kind === null){
            throw new TravellineInvalidValue("kind is empty");
        }

        if($kind === ServiceKind::COMMON) {
            $object->kind = ServiceKind::COMMON;
        }elseif($kind === ServiceKind::MEAL) {
            $object->kind = ServiceKind::MEAL;
        }else{
            throw new TravellineInvalidValue("Invalid kind type ".$kind );
        }

        $object->mealPlanCode = $array['mealPlanCode'] ?? null;
        $object->mealPlanName = $array['mealPlanName'] ?? null;

        $object->images = [];
        if(array_key_exists('images', $array) and is_array($array['images'])) {
            foreach ($array['images'] as $image) {
                $object->images[] =  Resource::createFromArray($image);
            }
        }

        if(array_key_exists('vat', $array)){
            $object->vat = Vat::createFromArray($array['vat']);
        }

        return $object;
    }


}