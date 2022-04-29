<?php

namespace egik\TravellineApi\ResponseDto\Content\SpecifiedProperty;

class RatePlan
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
     * @var string
     */
    protected $currency;

    /**
     * @var array<int, string>
     */
    protected $includedServicesIds;

    /**
     * @var Vat
     */
    protected $vat;

    /**
     * @var
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