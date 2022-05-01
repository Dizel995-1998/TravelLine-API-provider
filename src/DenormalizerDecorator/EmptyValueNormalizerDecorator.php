<?php

namespace egik\TravellineApi\DenormalizerDecorator;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

class EmptyValueNormalizerDecorator implements  NormalizerInterface, DenormalizerInterface, SerializerAwareInterface, CacheableSupportsMethodInterface
{
    /**
     * @var AbstractNormalizer
     */
    protected $normalizer;

    public function __construct(AbstractNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        $filterFunc = function ($item) {
            return !empty($item);
        };

        return array_filter($this->normalizer->normalize($object, $format, $context), $filterFunc);
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $this->normalizer->supportsNormalization($data, $format);
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return $this->normalizer->hasCacheableSupportsMethod();
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return $this->normalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $this->normalizer->supportsDenormalization($data, $type, $format);
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        $this->normalizer->setSerializer($serializer);
    }
}