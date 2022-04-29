<?php

namespace egik\TravellineApi\RequestDto\Search\RoomStays;

class RoomStays
{
    /**
     * Ограничение на стороне API TravelLine
     */
    public const PROPERTY_IDS_COUNT_LIMIT = 200;

    /**
     * Идентификаторы средств размещений
     * @var int[]
     */
    protected $propertyIds = [];

    /**
     * Возраста детей
     * @var int[]
     */
    protected $childAges = [];

    /**
     * Добавить в ответ допольнительную информацию о категориях и тарифах
     * по умолчанию пустой, но можно принимать значения:
     * roomTypeShortContent - только контент по категорим
     * ratePlanShortContent - только контент по тарифам
     * roomTypeShortContent|ratePlanShortContent - контент по категориям и тарифам
     * @var bool
     */
    protected $include;

    /**
     * Дата заезда ISO-8601 YYYY-MM-DD
     * @var \DateTimeImmutable
     */
    protected $arrivalDate;

    /**
     * Дата выезда ISO-8601 YYYY-MM-DD
     * @var \DateTimeImmutable
     */
    protected $departureDate;

    /**
     * Количество взрослых
     * @var int
     */
    protected $adults;

    public function __construct(
        int $adults,
        \DateTimeImmutable $arrivalDate,
        \DateTimeImmutable $departureDate,
        bool $include = true
    ) {
        $this->adults = $adults;
        $this->include = $include;
        $this->arrivalDate = $arrivalDate;
        $this->departureDate = $departureDate;
    }

    public function addPropertyId(int $propertyId): void
    {
        if (count($this->propertyIds) > self::PROPERTY_IDS_COUNT_LIMIT) {
            throw new \RuntimeException(
                'Quantity of property ids is limited %d things', self::PROPERTY_IDS_COUNT_LIMIT
            );
        }

        $this->propertyIds[] = $propertyId;
    }

    public function setPropertyIds(int ...$propertyIds): void
    {
        $this->propertyIds = $propertyIds;
    }

    public function addChildAge(int $childAge): void
    {
        $this->childAges[] = $childAge;
    }

    public function setChildAges(int ...$childAges): void
    {
        $this->childAges = $childAges;
    }

    public function setInclude(bool $include): void
    {
        $this->include = $include;
    }
}