<?php


namespace  egik\TravellineApi\Types\ErrorTypes;

/**
 * Объект ошибки при неправильном запросе
 */
class ErrorResponseItem
{
    /**
     * Код ошибки
     * @var string|null
     */
    public $code;

    /**
     * Текст ошибки
     * @var string|null
     */
    public $message;

    public static function createFromArray(array $array): self
    {
        $object = new static();
        $object->code = $array['code'] ?? null;
        $object->message = $array['message'] ?? null;
        return $object;
    }


}


