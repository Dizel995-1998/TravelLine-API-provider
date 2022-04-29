<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class RoomStay
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $propertyId;

    /**
     * @var RoomType
     */
    private $roomType;

    /**
     * @var array<string, string>
     */
    private $ratePlan;

    /**
     * @var GuestCount
     */
    private $guestCount;

    /**
     * @var StayDates
     */
    private $stayDates;

    /**
     * @var int
     */
    private $availability;

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var Total
     */
    private $total;

    /**
     * @var CancellationPolicy
     */
    private $cancellationPolicy;

    /**
     * @var IncludeService[]
     */
    private $includedServices;

    /**
     * @var string
     */
    private $mealPlanCode;

    /**
     * @var string
     */
    private $checksum;

    /**
     * @var string
     */
    private $fullPlacementsName;

    public function getKey(): string
    {
        return $this->key;
    }

    public function getPropertyId(): string
    {
        return $this->propertyId;
    }

    // todo: is nullable?
    public function getRoomType(): RoomType
    {
        return $this->roomType;
    }

    public function getRatePlan(): array
    {
        return $this->ratePlan;
    }

    public function getGuestCount(): GuestCount
    {
        return $this->guestCount;
    }

    public function getStayDates(): StayDates
    {
        return $this->stayDates;
    }

    public function getAvailability(): int
    {
        return $this->availability;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getTotal(): Total
    {
        return $this->total;
    }

    public function getCancellationPolicy(): CancellationPolicy
    {
        return $this->cancellationPolicy;
    }

    public function getIncludedServices(): array
    {
        return $this->includedServices;
    }

    public function getMealPlanCode(): string
    {
        return $this->mealPlanCode;
    }

    public function getChecksum(): string
    {
        return $this->checksum;
    }

    public function getFullPlacementsName(): string
    {
        return $this->fullPlacementsName;
    }
}