<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class Service extends \egik\TravellineApi\ResponseDto\Property\Service
{
    /**
     * @var array<string, string>
     */
    protected $images;

    /**
     * @var Vat
     */
    protected $vat;

    /**
     * @return string[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return Vat
     */
    public function getVat(): Vat
    {
        return $this->vat;
    }
}