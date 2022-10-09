<?php

declare(strict_types=1);

namespace Papyrus\SymfonySerializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class SymfonySerializerFactory
{
    public static function create(): SymfonySerializer
    {
        return new SymfonySerializer(new Serializer([
            new DateTimeNormalizer([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d\TH:i:s.uP']),
            new ObjectNormalizer(),
        ], [
            new JsonEncoder(),
        ]), JsonEncoder::FORMAT);
    }
}
