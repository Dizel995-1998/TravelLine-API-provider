<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

class Placement
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var int
     */
    protected $count;

    /**
     * @var string
     */
    protected $kind;

    /**
     * @var int|null
     */
    protected $minAge;

    /**
     * @var int|null
     */
    protected $maxAge;

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