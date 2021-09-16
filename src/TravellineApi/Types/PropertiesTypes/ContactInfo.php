<?php


namespace  egik\TravellineApi\Types\PropertiesTypes;

use egik\TravellineApi\Types\Exceptions\TravellineInvalidValue;

/**
 * Контактная информация средства размещения
 */
class ContactInfo
{
    /**
     * Адрес средства размещения
     * @var Address
     */
    public $address;

    /**
     * Номера телефонов средства размещения
     * @var Phone[]|null
     */
    public $phones;

    /**
     * Email-адреса гостиницы
     * @var string[]|null
     */
    public $emails;

    /**
     * @param array $array
     * @return self
     * @throws TravellineInvalidValue
     */
    public static function createFromArray(array $array): self
    {
        $object = new static();
        $object->emails = [];
        if(array_key_exists( 'emails', $array) and is_array($array['emails'])) {
            $object->emails = $array['emails'];
        }

        $object->phones = [];
        if(array_key_exists( 'phones', $array)  and is_array($array['phones'])) {
            foreach ($array['phones'] as $phone) {
                $object->phones[] = Phone::createFromArray($phone);
            }
        }

        if(array_key_exists( 'address', $array) ) {
            $object->address =  Address::createFromArray($array['address']);
        }else{
            throw new TravellineInvalidValue("address is empty");
        }


        return $object;
    }


}