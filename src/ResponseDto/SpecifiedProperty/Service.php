<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class Service extends \egik\TravellineApi\ResponseDto\Property\Service
{
    /**
     * @var array<string, string>
     */
    private $images;

    /**
     * @var Vat
     */
    private $vat;

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