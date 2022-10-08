<?php

declare(strict_types=1);

namespace Papyrus\SymfonySerializer\Test;

use DateTimeImmutable;
use DateTimeZone;
use Papyrus\SymfonySerializer\SymfonySerializer;
use Papyrus\SymfonySerializer\Test\Stub\TestDomainEvent;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @internal
 */
class SymfonySerializerTest extends TestCase
{
    private SymfonySerializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = new SymfonySerializer(new Serializer(
            [new DateTimeNormalizer([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d\TH:i:s.uP']), new ObjectNormalizer()],
            [new JsonEncoder()],
        ), JsonEncoder::FORMAT);

        parent::setUp();
    }

    /**
     * @test
     */
    public function itShouldSerialize(): void
    {
        $payload = $this->serializer->serialize(new TestDomainEvent(
            'c10a5410-1c3f-46a6-a0c5-7d4aa5bd5db0',
            12300,
            0.764334566872255,
            false,
            ['data' => ['true' => true, 'float' => 0.45]],
            new DateTimeImmutable('2022-10-08 08:13:23.537532', new DateTimeZone('CST')),
            null,
        ));

        self::assertSame((string) json_encode([
            'aggregateRootId' => 'c10a5410-1c3f-46a6-a0c5-7d4aa5bd5db0',
            'integer' => 12300,
            'float' => 0.764334566872255,
            'boolean' => false,
            'array' => ['data' => ['true' => true, 'float' => 0.45]],
            'dateTimeImmutable' => '2022-10-08T08:13:23.537532-06:00',
            'nullableString' => null,
        ]), $payload);
    }

    /**
     * @test
     */
    public function itShouldDeserialize(): void
    {
        /** @var TestDomainEvent $event */
        $event = $this->serializer->deserialize((string) json_encode([
            'aggregateRootId' => 'c10a5410-1c3f-46a6-a0c5-7d4aa5bd5db0',
            'integer' => 12300,
            'float' => 0.764334566872255,
            'boolean' => false,
            'array' => ['data' => ['true' => true, 'float' => 0.45]],
            'dateTimeImmutable' => '2022-10-08T08:13:23.537532-06:00',
            'nullableString' => null,
        ]), TestDomainEvent::class);

        self::assertInstanceOf(TestDomainEvent::class, $event);
        self::assertSame('c10a5410-1c3f-46a6-a0c5-7d4aa5bd5db0', $event->aggregateRootId);
        self::assertSame(12300, $event->integer);
        self::assertSame(0.764334566872255, $event->float);
        self::assertSame(false, $event->boolean);
        self::assertSame(['data' => ['true' => true, 'float' => 0.45]], $event->array);
        self::assertEquals(
            new DateTimeImmutable('2022-10-08 08:13:23.537532', new DateTimeZone('CST')),
            $event->dateTimeImmutable,
        );
        self::assertNull($event->nullableString);
    }
}
