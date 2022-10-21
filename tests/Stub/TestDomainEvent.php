<?php

declare(strict_types=1);

namespace Papyrus\SymfonySerializer\Test\Stub;

use DateTimeImmutable;

final class TestDomainEvent
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
}
