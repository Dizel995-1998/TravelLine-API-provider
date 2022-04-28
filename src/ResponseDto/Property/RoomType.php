<?php

namespace egik\TravellineApi\ResponseDto\Property;

class RoomType
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $amenities;

    /**
     * @var array
     */
    private $images;

    /**
     * @var RoomSize
     */
    private $size;

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