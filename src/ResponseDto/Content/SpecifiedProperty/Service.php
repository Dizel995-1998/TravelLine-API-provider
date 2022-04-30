<?php

namespace egik\TravellineApi\ResponseDto\Content\SpecifiedProperty;

class Service extends \egik\TravellineApi\ResponseDto\Content\Property\Service
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
