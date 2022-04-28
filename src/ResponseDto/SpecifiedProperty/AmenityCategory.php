<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class AmenityCategory
{
    /**
     * @var string
     */
    private $index;

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getIndex(): string
    {
        return $this->index;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}