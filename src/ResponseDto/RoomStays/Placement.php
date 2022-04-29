<?php

namespace egik\TravellineApi\ResponseDto\RoomStays;

class Placement
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var int
     */
    private $count;

    /**
     * @var string
     */
    private $kind;

    /**
     * @var int|null
     */
    private $minAge;

    /**
     * @var int|null
     */
    private $maxAge;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @return int|null
     */
    public function getMinAge(): ?int
    {
        return $this->minAge;
    }

    /**
     * @return int|null
     */
    public function getMaxAge(): ?int
    {
        return $this->maxAge;
    }
}