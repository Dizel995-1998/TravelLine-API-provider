<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use Exception;
use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 * Описание НДС
 */
class Vat
{
    /**
     * Пименяется ли НДС. Если false - значит без НДС, и тогда Included и Percent не указывается
     * @var bool
     */
    public $applicable;

    /**
     * Включена ли сумма НДС в Price
     * @var bool|null
     */
    public $included;

    /**
     * Описание тарифного плана, может содержать html-теги
     * @var integer|null
     */
    public $percent;


    /**
     * @param array $array
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        try {
            $object->applicable = $array['applicable'];
        } catch (Exception $e) {
            throw new TravellineInvalidValue("applicable is empty");
        }

        $object->included = $array['included'] ?? null;
        $object->percent = $array['percent'] ?? null;
        return $object;
    }


}
