<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class RatePlan
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
     * @var string
     */
    private $currency;

    /**
     * @var array<int, string>
     */
    private $includedServicesIds;

    /**
     * @var Vat
     */
    private $vat;

    /**
     * @var
     */
    private $roomTypes;

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
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string[]
     */
    public function getIncludedServicesIds(): array
    {
        return $this->includedServicesIds;
    }

    /**
     * @return Vat
     */
    public function getVat(): Vat
    {
        return $this->vat;
    }

    /**
     * @return mixed
     */
    public function getRoomTypes()
    {
        return $this->roomTypes;
    }
}