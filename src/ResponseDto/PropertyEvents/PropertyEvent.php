<?php

namespace egik\TravellineApi\ResponseDto\PropertyEvents;

class PropertyEvent
{
    /**
     * @var \DateTimeImmutable
     */
    private $created;

    /**
     * @var string
     */
    private $propertyId;

    /**
     * @var string
     */
    private $eventType;

    /**
     * @return \DateTimeImmutable
     */
    public function getCreated(): \DateTimeImmutable
    {
        return $this->created;
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