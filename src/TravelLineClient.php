<?php

namespace egik\TravellineApi;

// todo: разобраться с нейм спейсами
use egik\TravellineApi\Dto\MealPlan\MealPlan;
use egik\TravellineApi\Dto\Property\Property;
use egik\TravellineApi\Dto\PropertyEvents\PropertyEvent;
use egik\TravellineApi\Dto\RoomCategory\RoomTypeCategory;
use egik\TravellineApi\Exception\TravelLineBadResponseException;
use GuzzleHttp\Client;
use JsonSerializable;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use \egik\TravellineApi\Dto\SpecifiedProperty\Property as SpecifiedProperty;

/**
 * Провайдер для работы с API Travelline (todo: добавить ссылку на сваггер)
 */
class TravelLineClient
{
    protected const DEFAULT_BASE_URL = 'https://partner.qatl.ru/api';

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var Serializer
     */
    protected $serializer;

    public function __construct(
        Client $httpClient,
        Serializer $serializer,
        string $apiKey,
        string $baseUrl = self::DEFAULT_BASE_URL
    ) {
        $this->baseUrl = $this->deleteLastSlashIfNeed($baseUrl);
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    private function deleteLastSlashIfNeed(string $baseUrl): string
    {
        if (substr($baseUrl, 0, -1) == '/') {
            return substr($baseUrl, 0, strlen($baseUrl) - 1);
        }

        return $baseUrl;
    }

    protected function sendRequest(
        string $httpMethod, // todo: заменить перечислением при переходе на 8.0
        string $endpoint,
        array $queryParams = [],
        $requestBody = null, // todo: можем принимать только массив?
        bool $throwExceptionWhenFail = true,
        int &$httpResponseCode = 0
    ): array {
        // fixme: избавиться от говно проверки при переходе на 8.0
        if (
            !$requestBody instanceof JsonSerializable &&
            !is_array($requestBody) &&
            !is_string($requestBody) &&
            !is_null($requestBody)
        ) {
            $errMsg =
                '$requestBody argument support one of "array, string, JsonSerializable" type, but '
                . gettype($requestBody) . ' was given';

            throw new \InvalidArgumentException($errMsg);
        }

        $response = $this->httpClient->request($httpMethod, $this->baseUrl . $endpoint, [
            'headers' => [
                'X-API-KEY' => $this->apiKey,
            ],
            'body' => $requestBody,
            'http_errors' => false,
            'query' => $queryParams,
            'timeout' => 60,
        ]);

        $httpResponseCode = $response->getStatusCode();

        if ($throwExceptionWhenFail === true && !$this->isSuccessResponse($response)) {
            throw new TravelLineBadResponseException($response->getBody()->getContents(), $httpResponseCode);
        }

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    private function isSuccessResponse(ResponseInterface $response): bool
    {
        return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
    }

    /**
     *  Получения событий по всем средствам размещений.
     * @return PropertyEvent[]|null
     */
    public function getPropertiesEvents(?\DateTimeImmutable $filterAfterTime = null, ?int $count = null): ?array
    {
        static $continue = null;

        $query = [
            'continue' => $continue,
            'count' => $count,
            'timestamp' => $filterAfterTime,
        ];

        $deserializedData = $this->sendRequest(
            'GET',
            '/content/v1/properties/events',
            $query,
        );

        if (!$deserializedData['hasMoreData']) {
            return null;
        }

        $continue = $deserializedData['continue'] ?? null;
        return $this->serializer->denormalize($deserializedData, PropertyEvent::class . '[]', JsonEncoder::FORMAT);
    }

    /**
     *  Получение информации о средствах размещения
     * @return Property[]|null
     */
    public function getProperties(?int $count = null, bool $includeAllData = true): ?array
    {
        static $since = null;

        $response = $this->sendRequest('GET', '/content/v1/properties', [
            'since' => $since,
            'count' => $count,
            'include' => $includeAllData ? 'all' : null,
        ]);

        $since = $response['next'] ?? null;
        return $this->serializer->denormalize($response['properties'], Property::class . '[]', JsonEncoder::FORMAT);
    }

    /**
     * todo: уточнить что возвращается если объект не найден
     *
     * Получить информацию о конкретном средстве размещения
     * @return SpecifiedProperty
     */
    public function getPropertyById(string $propertyId): SpecifiedProperty
    {
        $response = $this->sendRequest('GET', '/content/v1/properties/' . $propertyId);
        return $this->serializer->denormalize($response, SpecifiedProperty::class, JsonEncoder::FORMAT);
    }

    /**
     *  Получить информацию о возможном питании
     * @return MealPlan[]
     */
    public function getMealPlans(): array
    {
        $response = $this->sendRequest('GET', '/content/v1/meal-plans');
        return $this->serializer->denormalize($response, MealPlan::class . '[]', JsonEncoder::FORMAT);
    }

    /**
     * Получить информацию о возможном питании
     * @return RoomTypeCategory[]
     */
    public function getRoomTypeCategories(): array
    {
        $response = $this->sendRequest('GET', '/content/v1/room-type-categories');
        return $this->serializer->denormalize($response, RoomTypeCategory::class . '[]', JsonEncoder::FORMAT);
    }
}
