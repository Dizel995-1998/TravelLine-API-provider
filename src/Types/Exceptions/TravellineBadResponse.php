<?php


namespace  egik\TravellineApi\Types\Exceptions;

use Exception;
use egik\TravellineApi\Types\ErrorTypes\ErrorResponse;

/**
 * Исключение содержащая объект-ошибку
 */
class TravellineBadResponse extends Exception
{
    /**
     * Свойство имеет тип ErrorResponse если в ответе на запрос имеется ключ errors
     * @var ErrorResponse|null
     */
    public $errorsResponse;

    /**
     * HTTP ответ массивом
     * @var array|null
     */
    public $response;

    /**
     * HTTP статус ответа
     * @var integer
     */
    public $httpStatus;

    function __construct(array $response, $httpStatus=null) {
        $this->httpStatus = $httpStatus;
        $this->response = $response;
        if(array_key_exists('errors', $response)) {
            $this->errorsResponse = ErrorResponse::createFromArray($response);
        }

        parent::__construct($this->format($this->response));
    }

    private function format(array $response): string
    {
        return json_encode($response).' http code '.$this->httpStatus;
    }


}
