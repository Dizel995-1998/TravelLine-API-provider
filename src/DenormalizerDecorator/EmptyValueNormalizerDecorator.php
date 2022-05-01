<?php

namespace egik\TravellineApi\DenormalizerDecorator;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

class EmptyValueNormalizerDecorator implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface,
                                               CacheableSupportsMethodInterface
{
    /**
     * @var AbstractNormalizer
     */
    protected $normalizer;

    public function __construct(AbstractNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    private function array_filter_recursive(array $input, callable $callback): array
    {
        foreach ($input as &$value) {
            if (!is_array($value)) {
                continue;
            }

            $value = $this->array_filter_recursive($value, $callback);
        }

        return array_filter($input, $callback);
    }

    private function filterEmptyValues($data): array
    {
        $filterFunc = function ($value) {
            return !empty($value);
        };

        return $this->array_filter_recursive($data, $filterFunc);
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return $this->filterEmptyValues($this->normalizer->normalize($object, $format, $context));
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
        return $this->normalizer->denormalize($this->filterEmptyValues($data), $type, $format, $context);
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