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
}