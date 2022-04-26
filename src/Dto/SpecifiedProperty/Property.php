<?php

namespace egik\TravellineApi\Dto\SpecifiedProperty;

use egik\TravellineApi\Dto\Property\Policy;

class Property
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $images;

    /**
     * @var int
     */
    private $stars;

    /**
     * @var ContactInfo
     */
    private $contactInfo;

    /**
     * @var Policy
     */
    private $policy;

    /**
     * @var array<string, string>
     */
    private $timeZone;

    /**
     * @var RatePlan[]
     */
    private $ratePlans;

    /**
     * @var Service[]
     */
    private $services;

    /**
     * @var AmenityCategory[]
     */
    private $amenityCategories;

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
     * @return string[]
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
}