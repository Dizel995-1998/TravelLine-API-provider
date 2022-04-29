<?php

namespace egik\TravellineApi\ResponseDto\Content\Property;

use egik\TravellineApi\ResponseDto\Content\SpecifiedProperty\ContactInfo;

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
     * @var RatePlan[]
     */
    protected $ratePlans;

    /**
     * @var RoomType[]
     */
    protected $roomTypes;

    /**
     * @var Service[]
     */
    protected $services;

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