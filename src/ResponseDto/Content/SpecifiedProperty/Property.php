<?php

namespace egik\TravellineApi\ResponseDto\Content\SpecifiedProperty;

use egik\TravellineApi\ResponseDto\Content\Property\Policy;

class Property
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $images;

    /**
     * @var int
     */
    protected $stars;

    /**
     * @var ContactInfo
     */
    protected $contactInfo;

    /**
     * @var Policy
     */
    protected $policy;

    /**
     * @var array<string, string>
     */
    protected $timeZone;

    /**
     * @var RatePlan[]
     */
    protected $ratePlans;

    /**
     * @var Service[]
     */
    protected $services;

    /**
     * @var AmenityCategory[]
     */
    protected $amenityCategories;

    /**
     * @var RoomType[]
     */
    protected $roomTypes;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * @return ContactInfo
     */
    public function getContactInfo(): ContactInfo
    {
        return $this->contactInfo;
    }

    /**
     * @return Policy
     */
    public function getPolicy(): Policy
    {
        return $this->policy;
    }

    /**
     * @return array<string, string>
     */
    public function getTimeZone(): array
    {
        return $this->timeZone;
    }

    /**
     * @return RatePlan[]
     */
    public function getRatePlans(): array
    {
        return $this->ratePlans;
    }

    /**
     * @return Service[]
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @return AmenityCategory[]
     */
    public function getAmenityCategories(): array
    {
        return $this->amenityCategories;
    }

    /**
     * @return RoomType[]
     */
    public function getRoomTypes(): array
    {
        return $this->roomTypes;
    }
}