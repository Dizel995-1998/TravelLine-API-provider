<?php

namespace egik\TravellineApi\DenormalizerDecorator;

use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DenormalizerDecorator implements DenormalizerInterface
{
    /**
     * @var DenormalizerInterface
     */
    protected $originDenormalizer;

    public function __construct(DenormalizerInterface $originDenormalizer)
    {
        $this->originDenormalizer = $originDenormalizer;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        if ($data === null) {
        }
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $this->supportsDenormalization($data, $type, $format);
    }
}
