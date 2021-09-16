<?php

namespace egik\TravellineApi;

use DateTime;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Client;
use egik\TravellineApi\Types\PropertyEventTypes\PropertyEvents;
use egik\TravellineApi\Types\PropertiesTypes\PropertyInfoPage;
use egik\TravellineApi\Types\PropertiesTypes\PropertyInfoType;
use egik\TravellineApi\Types\PropertiesTypes\MealPlan;
use egik\TravellineApi\Types\PropertiesTypes\RoomTypeCategory;
use egik\TravellineApi\Types\Exceptions\TravellineBadResponse;

/**
 * Класс с методами API
 */
class ContentApi
{
    /**
     * ключ API
     * @var string
     */
    public $apiKey;

    /**
     *  Хост для запросов
     * @var string
     */
    public $host = 'https://partner.qatl.ru/api/content/';

    protected $httpClient;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new Client([
            'timeout' => 60,
            'base_uri' => $this->host,
        ]);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws TravellineBadResponse
     */
    private function sendRequest(string $endpoint, array $data):array {
        try {
            $response = $this->httpClient->request('GET', $endpoint, [
                'headers' => [
                    'X-API-KEY' => $this->apiKey,
                ],
                'query' => $data,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (BadResponseException  $e) {
            $responseString = $e->getResponse()->getBody()->getContents();
            $response = json_decode($responseString, true);
            if(is_array($response)) {
                throw new TravellineBadResponse($response, (int) $e->getCode());
            }else{
                throw new TravellineBadResponse(["response" => $responseString], (int) $e->getCode());
            }

        }
    }


    /**
     *  Получения событий по всем средствам размещений.
     * @param string|null $continue
     * @param DateTime|null $timestamp
     * @param integer|null $count
     * @return PropertyEvents
     * @throws TravellineBadResponse
     * @throws Types\Exceptions\TravellineInvalidValue
     */
    public function getEvents(string $continue=null, DateTime $timestamp=null, int $count=null): PropertyEvents
    {
         $endpoint = 'v1/properties/events';
         $data = [];
         if(!empty($count)) {
             $data["count"] = $count;
         }
         if(!empty($continue)) {
             $data["continue"] = $continue;
         }
         if(!empty($timestamp)) {
             $data["timestamp"] = $timestamp->format(DateTime::ISO8601);
         }
         $response = $this->sendRequest($endpoint, $data);
         return PropertyEvents::createFromArray($response);
    }


    /**
     *  Получение информации о средствах размещения
     * @param string|null $since
     * @param string|null $count
     * @return PropertyInfoPage
     * @throws TravellineBadResponse|Types\Exceptions\TravellineInvalidValue
     */
    public function getProperties(string $since=null, string $count=null): PropertyInfoPage
    {
        $endpoint = 'v1/properties';
        $data = [];
        if(!empty($since)) {
            $data["since"] = $since;
        }
        if(!empty($count)) {
            $data["count"] = $count;
        }
        $response = $this->sendRequest($endpoint, $data);
        return PropertyInfoPage::createFromArray($response);
    }

    /**
     *  Получить информацию о конкретном средстве размещения
     * @param string $propertyId
     * @return PropertyInfoType
     * @throws TravellineBadResponse
     * @throws Types\Exceptions\TravellineInvalidValue
     */
    public function getPropertyById(string $propertyId): PropertyInfoType
    {
        $endpoint = 'v1/properties/'.$propertyId;
        $response = $this->sendRequest($endpoint, []);
        return PropertyInfoType::createFromArray($response);
    }


    /**
     *  Получить информацию о возможном питании
     * @return MealPlan[]
     * @throws TravellineBadResponse
     */
    public function getMealPlans(): array
    {
        $endpoint = 'v1/meal-plans';
        $response = $this->sendRequest($endpoint, []);
        $mealPlans = [];
        foreach ($response as $mealPlan) {
            $mealPlans[] = MealPlan::createFromArray($mealPlan);
        }
        return $mealPlans;
    }


    /**
     *  Получить информацию о возможном питании
     * @return RoomTypeCategory[]
     * @throws TravellineBadResponse
     */
    public function getRoomTypeCategories(): array
    {
        $endpoint = 'v1/room-type-categories';
        $response = $this->sendRequest($endpoint, []);
        $roomTypeCategories = [];
        foreach ($response as $roomTypeCategory) {
            $roomTypeCategories[] = RoomTypeCategory::createFromArray($roomTypeCategory);
        }
        return $roomTypeCategories;
    }

}
