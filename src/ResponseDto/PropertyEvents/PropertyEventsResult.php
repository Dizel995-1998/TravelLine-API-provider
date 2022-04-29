<?php

namespace egik\TravellineApi\ResponseDto\PropertyEvents;

class PropertyEventsResult
{
    /**
     * @var PropertyEvent[]
     */
    protected $events;

    /**
     * @var bool
     */
    protected $hasMoreData;

    /**
     * @return PropertyEvent[]
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