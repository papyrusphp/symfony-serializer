<?php

declare(strict_types=1);

namespace Papyrus\SymfonySerializer;

use Papyrus\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @implements Serializer<object>
 */
final class SymfonySerializer implements Serializer
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly string $format,
    ) {
    }

    public function serialize(object $object): string
    {
        return $this->serializer->serialize($object, $this->format);
    }

    /**
     * @param class-string<object> $objectClassName
     */
    public function deserialize(mixed $payload, string $objectClassName): object
    {
        /* @phpstan-ignore-next-line */
        return $this->serializer->deserialize($payload, $objectClassName, $this->format);
    }
}
