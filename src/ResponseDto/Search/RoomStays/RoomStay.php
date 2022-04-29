<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

class RoomStay
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $propertyId;

    /**
     * @var RoomType
     */
    protected $roomType;

    /**
     * @var array<string, string>
     */
    protected $ratePlan;

    /**
     * @var GuestCount
     */
    protected $guestCount;

    /**
     * @var StayDates
     */
    protected $stayDates;

    /**
     * @var int
     */
    protected $availability;

    /**
     * @var string
     */
    protected $currencyCode;

    /**
     * @var Total
     */
    protected $total;

    /**
     * @var CancellationPolicy
     */
    protected $cancellationPolicy;

    /**
     * @var IncludedService[]
     */
    protected $includedServices;

    /**
     * @var string
     */
    protected $mealPlanCode;

    /**
     * @var string
     */
    protected $checksum;

    /**
     * @var string
     */
    protected $fullPlacementsName;

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