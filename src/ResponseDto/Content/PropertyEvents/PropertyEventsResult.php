<?php

namespace egik\TravellineApi\ResponseDto\Content\PropertyEvents;

use Symfony\Component\Validator\Constraints as Assert;

class PropertyEventsResult
{
    /**
     * @var PropertyEvent[]|null
     */
    protected $events;

    /**
     * @Assert\Type("boolean")
     * @var bool
     */
    protected $hasMoreData;

    /**
     * @return PropertyEvent[]|null
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * @return bool
     */
    public function isHasMoreData(): bool
    {
        return $this->hasMoreData;
    }
}
