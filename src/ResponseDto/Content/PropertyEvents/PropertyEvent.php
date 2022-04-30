<?php

namespace egik\TravellineApi\ResponseDto\Content\PropertyEvents;

class PropertyEvent
{
    /**
     * @var string
     */
    protected $created;

    /**
     * @var string
     */
    protected $propertyId;

    /**
     * @var string
     */
    protected $eventType;

    /**
     * @return \DateTimeImmutable
     */
    public function getCreated(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->created);
    }

    /**
     * @return string
     */
    public function getPropertyId(): string
    {
        return $this->propertyId;
    }

    /**
     * @return string
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }
}
