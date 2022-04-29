<?php

namespace egik\TravellineApi\ResponseDto\Content\Property;

class RoomType
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $amenities;

    /**
     * @var array
     */
    protected $images;

    /**
     * @var RoomSize
     */
    protected $size;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getAmenities(): array
    {
        return $this->amenities;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return RoomSize
     */
    public function getSize(): RoomSize
    {
        return $this->size;
    }
}