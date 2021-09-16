<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;


/**
 * Номер для связи со средством размещения
 */
class Phone
{
    /**
     * Номер телефона
     * @var string|null
     */
    public $phoneNumber;

    /**
     * Комментарий к номеру телефона
     * @var string|null
     */
    public $remark;


    /**
     * @param array $array
     * @return self
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        $object->phoneNumber = $array['phoneNumber'] ?? null;
        $object->remark = $array['remark'] ?? null;
        return $object;
    }

}