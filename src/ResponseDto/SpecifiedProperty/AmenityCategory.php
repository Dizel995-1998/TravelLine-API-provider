<?php

namespace egik\TravellineApi\ResponseDto\SpecifiedProperty;

class AmenityCategory
{
    /**
     * @var int
     */
    protected $index;

    /**
     * @var string
     */
    protected $name;

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