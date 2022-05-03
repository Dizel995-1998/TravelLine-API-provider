<?php

namespace egik\TravellineApi\ResponseDto\Content\PropertyEvents;

use Symfony\Component\Validator\Constraints as Assert;

class PropertyEvent
{
    /**
     * todo: костыль с Assert'ами, нужна поддержка PHP 7.4 с строгой типизацией свойств
     * @Assert\Type("string")
     * @var string
     */
    protected $created;

    /**
     * @Assert\Type("string")
     * @var string
     */
    protected $propertyId;

    /**
     * @Assert\Type("string")
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
