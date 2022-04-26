<?php

namespace egik\TravellineApi\Dto\Property;

use egik\TravellineApi\Dto\SpecifiedProperty\ContactInfo;

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
     * @var RatePlan[]
     */
    private $ratePlans;

    /**
     * @var RoomType[]
     */
    private $roomTypes;

    /**
     * @var Service[]
     */
    private $services;

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
     * @return RatePlan[]
     */
    public function getRatePlans(): array
    {
        return $this->ratePlans;
    }

    /**
     * @return RoomType[]
     */
    public function getRoomTypes(): array
    {
        return $this->roomTypes;
    }

    /**
     * @return Service[]
     */
    public function getServices(): array
    {
        return $this->services;
    }
}