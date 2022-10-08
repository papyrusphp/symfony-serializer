<?php

declare(strict_types=1);

namespace Papyrus\SymfonySerializer\Test\Stub;

use DateTimeImmutable;
use Papyrus\EventSourcing\DomainEvent;

final class TestDomainEvent implements DomainEvent
{
    /**
     * @param array<mixed> $array
     */
    public function __construct(
        public readonly string $aggregateRootId,
        public readonly int $integer,
        public readonly float $float,
        public readonly bool $boolean,
        public readonly array $array,
        public readonly DateTimeImmutable $dateTimeImmutable,
        public readonly ?string $nullableString,
    ) {
    }

    public static function getEventName(): string
    {
        return 'test.domain_event';
    }

    public function getAggregateRootId(): string
    {
        return $this->aggregateRootId;
    }
}
