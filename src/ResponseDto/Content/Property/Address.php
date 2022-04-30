<?php

namespace egik\TravellineApi\ResponseDto\Content\Property;

class Address
{
    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $regionId;

    /**
     * @var string
     */
    protected $cityName;

    /**
     * @var string
     */
    protected $cityId;

    /**
     * @var string
     */
    protected $addressLine;

    /**
     * @var float
     */
    protected $latitude;

    /**
     * @var float
     */
    protected $longitude;

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
