<?php

namespace egik\TravellineApi;

// todo: разобраться с нейм спейсами
use egik\TravellineApi\Normalizer\PropertyNormalizerDecorator;
use egik\TravellineApi\Exception\TravelLineBadResponseException;
use egik\TravellineApi\RequestDto\Reservation\CreateBooking\CreateBookingRequest;
use egik\TravellineApi\RequestDto\Reservation\Verify\VerifyBookingRequest;
use egik\TravellineApi\RequestDto\Search\RoomStays\RoomStays;
use egik\TravellineApi\ResponseDto\Content\MealPlan\MealPlan;
use egik\TravellineApi\ResponseDto\Content\Property\PropertiesResult;
use egik\TravellineApi\ResponseDto\Content\PropertyEvents\PropertyEventsResult;
use egik\TravellineApi\ResponseDto\Content\RoomCategory\RoomTypeCategory;
use egik\TravellineApi\ResponseDto\Content\SpecifiedProperty\Property as SpecifiedProperty;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\CreatedBookingResult;
use egik\TravellineApi\ResponseDto\Reservation\Verify\VerifyBookingResult;
use egik\TravellineApi\ResponseDto\Search\RoomStays\RoomStays as RoomStaysResponse;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * todo: добавить в тестах strict type = 1 в бутстрап файле
 * todo: подключить Assert компонент для валидации респонс ДТО
 * todo: добавить GitLab CI в проект, проверка codestyle, psalm, unit tests
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

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(
        Client $httpClient,
        string $apiKey,
        string $baseUrl = self::DEFAULT_BASE_URL
    ) {
        $this->baseUrl = $this->deleteLastSlashIfNeed($baseUrl);
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
        $this->serializer = $this->getSerializer();
        $this->validator = $this->getValidator();
    }

    private function getValidator(): ValidatorInterface
    {
        return Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();
    }

    private function getSerializer(): Serializer
    {
        $arrayDenormalized = new ArrayDenormalizer();
        $propertyNormalizer = new PropertyNormalizer(null, null, new PhpDocExtractor());
        $arrayDenormalized->setDenormalizer($propertyNormalizer);

        return new Serializer([$arrayDenormalized, new JsonSerializableNormalizer(), $propertyNormalizer], [new JsonEncoder()]);
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
            $requestBody = $this->serializer->normalize($requestBody, null, [
                AbstractObjectNormalizer::SKIP_NULL_VALUES => true
            ]);
        }

        $response = $this->httpClient->request($httpMethod, $this->baseUrl . $endpoint, [
            'headers' => [
                'X-API-KEY' => $this->apiKey,
            ],
            'body' => $requestBody, // todo: maybe json key?
            'http_errors' => false,
            'query' => $queryParams,
            'timeout' => 60,
        ]);

        $httpResponseCode = $response->getStatusCode();

        if ($throwExceptionWhenFail === true && !$this->isSuccessResponse($response)) {
            throw new TravelLineBadResponseException($response->getBody()->getContents(), $httpResponseCode);
        }

        // todo: заюзать функционал сериалайзера
        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    protected function isSuccessResponse(ResponseInterface $response): bool
    {
        return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
    }

    /**
     * @template T of DTO
     * @param array $denormalizedData
     * @param class-string<T> $toDtoClass
     * @return T
     */
    protected function hydrateResponseDto(array $denormalizedData, string $toDtoClass)
    {
        $responseDto = $this->serializer->denormalize($denormalizedData, $toDtoClass, JsonEncoder::FORMAT);
        // todo: maybe add if for array values
        $this->validator->validate($responseDto);

        return $responseDto;
    }

    /**
     *  Получения событий по всем средствам размещений.
     * @return PropertyEventsResult
     */
    public function getPropertiesEvents(?\DateTimeImmutable $filterAfterTime = null, ?int $count = null): PropertyEventsResult
    {
        static $continue = null;

        $query = [
            'continue' => $continue,
            'count' => $count,
            'timestamp' => $filterAfterTime,
        ];

        $response = $this->sendRequest(
            'GET',
            '/content/v1/properties/events',
            $query,
        );

        $continue = $response['continue'] ?? null;
        return $this->hydrateResponseDto($response, PropertyEventsResult::class);
    }

    /**
     *  Получение информации о средствах размещения
     * @return PropertiesResult
     */
    public function getProperties(?int $count = null, bool $includeAllData = true): PropertiesResult
    {
        static $since = null;

        $response = $this->sendRequest('GET', '/content/v1/properties', [
            'since' => $since,
            'count' => $count,
            'include' => $includeAllData ? 'all' : null,
        ]);

        $since = $response['next'] ?? null;
        return $this->hydrateResponseDto($response, PropertiesResult::class);
    }

    /**
     * Получить информацию о конкретном средстве размещения
     * @return SpecifiedProperty
     */
    public function getPropertyById(string $propertyId): SpecifiedProperty
    {
        $response = $this->sendRequest('GET', '/content/v1/properties/' . $propertyId);
        return $this->hydrateResponseDto($response, SpecifiedProperty::class);
    }

    /**
     *  Получить информацию о возможном питании
     * @return MealPlan[]
     */
    public function getMealPlans(): array
    {
        $response = $this->sendRequest('GET', '/content/v1/meal-plans');
        return $this->hydrateResponseDto($response, MealPlan::class . '[]');
    }

    /**
     * Получить информацию о возможном питании
     * @return RoomTypeCategory[]
     */
    public function getRoomTypeCategories(): array
    {
        $response = $this->sendRequest('GET', '/content/v1/room-type-categories');
        return $this->hydrateResponseDto($response, RoomTypeCategory::class . '[]');
    }

    public function searchRoomStays(RoomStays $roomStays): RoomStaysResponse
    {
        $response = $this->sendRequest('POST', '/search/v1/properties/room-stays/search', [], $roomStays);
        return $this->hydrateResponseDto($response,RoomStaysResponse::class);
    }

    public function createBooking(CreateBookingRequest $bookingRequest): CreatedBookingResult
    {
        $response = $this->sendRequest('POST', '/reservation/v1/bookings', [], $bookingRequest);
        return $this->hydrateResponseDto($response['booking'], CreatedBookingResult::class);
    }

    public function verifyBooking(VerifyBookingRequest $verifyBookingRequest): VerifyBookingResult
    {
        $response = $this->sendRequest('POST', '/reservation/v1/bookings/verify', [], $verifyBookingRequest);
        return $this->hydrateResponseDto($response,VerifyBookingResult::class);
    }

    public function searchRoomStaysByPropertyId(
        string $propertyId,
        \DateTimeImmutable $arrivalDate,
        \DateTimeImmutable $departureDate,
        int $adults,
        bool $includeContent,
        ?array $childAges = null
    ): ResponseDto\Search\RoomStaysById\RoomStays {
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
        return $this->hydrateResponseDto($response,ResponseDto\Search\RoomStaysById\RoomStays::class);
    }
}
