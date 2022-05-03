<?php

namespace egik\TravellineApi;

// todo: разобраться с нейм спейсами
use egik\TravellineApi\DenormalizerDecorator\EmptyValueNormalizerDecorator;
use egik\TravellineApi\Exception\TravelLineBadResponseException;
use egik\TravellineApi\Exception\TravelLineInvalidResponseException;
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
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Mapping\PropertyMetadataInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * todo: добавить оставшейся JSON моки респонсов в папочку тестов
 * todo: задокументировать методы и добавить ссылку на флоу оформления в репу
 * todo: добавить в тестах strict type = 1 в бутстрап файле
 * todo: подключить Assert компонент для валидации респонс ДТО
 * todo: добавить GitLab CI в проект, проверка codestyle, psalm, unit tests
 * todo: подтянул лишние composer зависимости, посмотреть что юзаю, что нет
 * todo: В доке плохо описаны возвращаемые значения, уточнить у представителей TravelLine возможные коды ошибок
 * Провайдер для работы с API TravelLine (https://partner.qatl.ru/docs/booking-process/)
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
    }

    private function validate(string $dtoClassName, array $denormalizedData, bool $isCollection): void
    {
        if ($isCollection) {
            foreach ($denormalizedData as $datum) {
                $this->validate($dtoClassName, $datum, false);
            }

            return;
        }

        /** @psalm-suppress TooManyArguments */
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        /** @var ClassMetadata $metadata */
        $metadata = $validator->getMetadataFor($dtoClassName);
        $constraints = [];

        foreach ($metadata->getConstrainedProperties() as $propertyName) {
            $propertyMetadata = $metadata->getPropertyMetadata($propertyName);
            if (!empty($propertyMetadata)) {
                $propertyMetadata = current($propertyMetadata);
            }
            if (!($propertyMetadata instanceof PropertyMetadataInterface)) {
                continue;
            }

            $constraints[$propertyMetadata->getPropertyName()] = $propertyMetadata->getConstraints();
        }

        $constraintCollection = new Collection($constraints);
        $constraintCollection->allowExtraFields = true;

        $errors = [];

        /** @var ConstraintViolationInterface $violation */
        foreach ($validator->validate($denormalizedData, $constraintCollection) as $violation) {
            $field = preg_replace(['/\]\[/', '/\[|\]/'], ['.', ''], $violation->getPropertyPath());
            $errors[$field] = $violation->getMessage();
        }

        if (!empty($errors)) {
            throw new TravelLineInvalidResponseException($errors);
        }
    }

    private function getSerializer(): Serializer
    {
        $arrayDenormalized = new ArrayDenormalizer();
        $propertyNormalizer = new PropertyNormalizer(null, null, new PhpDocExtractor());

        $emptyValueNormalizer = new EmptyValueNormalizerDecorator($propertyNormalizer);

        $arrayDenormalized->setDenormalizer($emptyValueNormalizer);
        $dateTimeNormalizer = new DateTimeNormalizer([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d']);

        $jsonSerializble = new EmptyValueNormalizerDecorator(new JsonSerializableNormalizer());

        return new Serializer([$arrayDenormalized, $jsonSerializble, $emptyValueNormalizer, $dateTimeNormalizer], [new JsonEncoder()]);
    }

    private function deleteLastSlashIfNeed(string $baseUrl): string
    {
        if (str_ends_with($baseUrl, '/')) {
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

        if (!empty($requestBody) && strtolower($httpMethod) === 'GET') {
            throw new \LogicException('Невозможно отправить тело запроса используя GET глагол');
        }

        $options = [
            'headers' => ['X-API-KEY' => $this->apiKey],
            'http_errors' => false,
            'timeout' => 60,
        ];

        if (!empty($requestBody)) {
            $options['json'] = $requestBody;
        }

        if ($queryParams !== null) {
            $options['query'] = $queryParams;
        }

        $response = $this->httpClient->request($httpMethod, $this->baseUrl . $endpoint, $options);
        $httpResponseCode = $response->getStatusCode();

        if ($throwExceptionWhenFail === true && !$this->isSuccessResponse($response)) {
            throw new TravelLineBadResponseException($response->getBody()->getContents(), $httpResponseCode);
        }

        return $this->serializer->decode($response->getBody()->getContents(), JsonEncoder::FORMAT);
    }

    protected function isSuccessResponse(ResponseInterface $response): bool
    {
        return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
    }

    /**
     * @template T
     * @param array $denormalizedData
     * @param class-string<T> $toDtoClass
     * @return T
     */
    protected function hydrateResponseDto(array $denormalizedData, string $toDtoClass)
    {
        str_ends_with($toDtoClass, '[]') ?
            $this->validate(substr($toDtoClass, 0, -2), $denormalizedData, true) :
            $this->validate($toDtoClass, $denormalizedData, false);

        return $this->serializer->denormalize($denormalizedData, $toDtoClass, JsonEncoder::FORMAT);
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
        return $this->hydrateResponseDto($response, RoomStaysResponse::class);
    }

    public function createBooking(CreateBookingRequest $bookingRequest): CreatedBookingResult
    {
        $response = $this->sendRequest('POST', '/reservation/v1/bookings', [], $bookingRequest);
        return $this->hydrateResponseDto($response['booking'], CreatedBookingResult::class);
    }

    public function verifyBooking(VerifyBookingRequest $verifyBookingRequest): VerifyBookingResult
    {
        $response = $this->sendRequest('POST', '/reservation/v1/bookings/verify', [], $verifyBookingRequest);
        return $this->hydrateResponseDto($response, VerifyBookingResult::class);
    }

    /**
     * todo: Уточнить всегда ли TravelLine возвращает 400-ый код если ресурс не найден, либо же использует как то ещё
     */
    public function getBooking(string $number): CreatedBookingResult
    {
        $response = $this->sendRequest('GET', '/reservation/v1/bookings/' . $number);
        return $this->hydrateResponseDto($response, CreatedBookingResult::class);
    }

    public function cancelBooking(string $number, string $reason, int $expectedPenaltyAmount): CreatedBookingResult
    {
        $point = '/reservation/v1/bookings/' . $number . '/cancel';

        $requestBody = [
            'reason' => $reason,
            'expectedPenaltyAmount' => $expectedPenaltyAmount,
        ];

        $response = $this->sendRequest('POST', $point, [], $requestBody);
        return $this->hydrateResponseDto($response, CreatedBookingResult::class);
    }

    /**
     * Рассчитать сумму штрафа за отмену
     */
    public function calculateCancellationPenalty(string $number, string $reason, int $expectedPenaltyAmount): int
    {
        $point = '/reservation/v1/bookings/' . $number . '/cancel';

        $requestBody = [
            'reason' => $reason,
            'expectedPenaltyAmount' => $expectedPenaltyAmount,
        ];

        $response = $this->sendRequest('POST', $point, [], $requestBody);

        if ($response['penaltyAmount'] === null) {
            throw new \RuntimeException('"penaltyAmount" was not returned');
        }

        return (int) $response['penaltyAmount'];
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
        return $this->hydrateResponseDto($response, ResponseDto\Search\RoomStaysById\RoomStays::class);
    }
}
