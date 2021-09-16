<?php


namespace  egik\TravellineApi\Types\ErrorTypes;

/**
 * Контейнер для объектов-ошибок при неправильном запросе
 */
class ErrorResponse
{
    /**
     * Массив ошибок
     * @var ErrorResponseItem[]
     */
    public $errors;

    public static function createFromArray(array $array): self
    {
        $object = new static();
        $object->errors = [];
        if(is_array($array['errors'])) {
            foreach ($array['errors'] as $error) {
                $object->errors[] =  ErrorResponseItem::createFromArray($error);
            }
        }
        return $object;
    }


}
