<?php

namespace egik\TravellineApi\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Нормалайзер с поддержкой серилизации через JsonSerializable
 */
class PropertyNormalizerDecorator implements NormalizerInterface
{
    /**
     * @var NormalizerInterface
     */
    protected $normalizer;

    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        if ($object instanceof \JsonSerializable) {
            return $object->jsonSerialize();
        }

        return $this->normalizer->normalize($object, $format, $context);
    }

    public function supportsNormalization($data, string $format = null)
    {
        if ($data instanceof \JsonSerializable) {
            return true;
        }

        return $this->normalizer->supportsNormalization($data, $format);
    }
}