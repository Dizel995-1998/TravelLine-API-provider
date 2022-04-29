<?php

namespace egik\TravellineApi\ResponseDto\Content\Property;

class PropertiesResult
{
    /**
     * @var bool|null
     */
    protected $next;

    /**
     * @var Property[]
     */
    protected $properties;

    /**
     * @return bool
     */
    public function isNext(): bool
    {
        return (bool) $this->next;
    }

    /**
     * @return Property[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}