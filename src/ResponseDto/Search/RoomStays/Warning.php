<?php

namespace egik\TravellineApi\ResponseDto\Search\RoomStays;

use Symfony\Component\Validator\Constraints as Assert;

class Warning
{
    /**
     * @Assert\NotNull
     * @var string
     */
    protected $code;

    /**
     * @Assert\NotNull
     * @var string
     */
    protected $message;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}