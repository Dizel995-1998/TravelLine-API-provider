<?php

namespace egik\TravellineApi;

// todo: разобраться с нейм спейсами
use egik\TravellineApi\Dto\MealPlan\MealPlan;
use egik\TravellineApi\Dto\Property\Property;
use egik\TravellineApi\Dto\PropertyEvents\PropertyEvent;
use egik\TravellineApi\Dto\RoomCategory\RoomTypeCategory;
use egik\TravellineApi\Exception\TravelLineBadResponseException;
use egik\TravellineApi\RequestDto\RoomStays\RoomStays;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use \egik\TravellineApi\Dto\SpecifiedProperty\Property as SpecifiedProperty;
use \Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use  \egik\TravellineApi\ResponseDto\RoomStays\RoomStays as RoomStaysResponse;

/**
 * todo: подтянул лишние composer зависимости, посмотреть что юзаю, что нет
 * todo: оформить пакет как бандл
 * todo: В доке плохо описаны возвращаемые значения, уточнить у представителей TravelLine возможные коды ошибок
 * Провайдер для работы с API Travelline (https://partner.qatl.ru/docs/booking-process/)
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
        string $apiKey,
        string $baseUrl = self::DEFAULT_BASE_URL
    ) {
        $this->baseUrl = $this->deleteLastSlashIfNeed($baseUrl);
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;

        $arrayDenormalized = new ArrayDenormalizer();
        $propNormalizer = new PropertyNormalizer(null, null, new PhpDocExtractor());
        $arrayDenormalized->setDenormalizer($propNormalizer);
        $this->serializer = new Serializer([$arrayDenormalized, $propNormalizer], [new JsonEncoder()]);
    }

    private function deleteLastSlashIfNeed(string $baseUrl): string
    {
        if (substr($baseUrl, 0, -1) == '/') {
            return substr($baseUrl, 0, strlen($baseUrl) - 1);
        }

        return $baseUrl;
    }

    /**
     * @param string $httpMethod
     * @param string $endpoint
     * @param array $queryParams
     * @param object|array $requestBody
     * @param bool $throwExceptionWhenFail
     * @param int $httpResponseCode
     * @return array
     * @throws TravelLineBadResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    protected function sendRequest(
        string $httpMethod, // todo: заменить перечислением при переходе на 8.0
        string $endpoint,
        array $queryParams = [],
        $requestBody = [], // todo: заменить множественным типом при переходе на 8.0
        bool $throwExceptionWhenFail = true,
        int &$httpResponseCode = 0
    ): array {
        if (
            !is_array($requestBody) &&
            !is_object($requestBody)
        ) {
            throw new \InvalidArgumentException(sprintf(
                'Request body can be only array or object, %s was given',
                gettype($requestBody)
            ));
        }

        if (is_object($requestBody)) {
            $requestBody = $this->serializer->normalize($requestBody);
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

    public function searchRoomStays(RoomStays $roomStays): RoomStaysResponse
    {
        $response = $this->sendRequest('POST', '/search/v1/properties/room-stays/search', [], $roomStays);
        return $this->serializer->denormalize($response, RoomStaysResponse::class, JsonEncoder::FORMAT);
    }

    /**
     * todo: уточнить формат ответа
     */
    public function searchRoomStaysByPropertyId(
        string $propertyId,
        \DateTimeImmutable $arrivalDate,
        \DateTimeImmutable $departureDate,
        int $adults,
        bool $includeContent,
        ?array $childAges = null
    ): RoomStaysResponse {
        $queryParams = [
            'adults' => $adults,
            'childAges' => $childAges,
            'departureDate' => $departureDate,
            'arrivalDate' => $arrivalDate,
        ];

        if ($includeContent) {
            $queryParams['include'] = 'content';
        }

        $point = '/search/v1/properties/' . $propertyId . '/room-stays';
        $response = $this->sendRequest('GET', $point, $queryParams, []);
        return $this->serializer->denormalize($response, RoomStaysResponse::class, JsonEncoder::FORMAT);
    }


}
