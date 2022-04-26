<?php

namespace egik\TravellineApi\Dto\Property;

class Address
{
    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $regionId;

    /**
     * @var string
     */
    private $cityName;

    /**
     * @var string
     */
    private $cityId;

    /**
     * @var string
     */
    private $addressLine;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getRegionId(): string
    {
        return $this->regionId;
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return $this->cityName;
    }

    /**
     * @return string
     */
    public function getCityId(): string
    {
        return $this->cityId;
    }

    /**
     * @return string
     */
    public function getAddressLine(): string
    {
        return $this->addressLine;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }
}