<?php

declare(strict_types=1);

namespace TrackMe\Model;

use DateTimeImmutable;

final class Record
{
    private string $timeSpent;
    private string $description;
    private DateTimeImmutable $createdAt;

    public function __construct(string $timeSpent, string $description, DateTimeImmutable $createdAt = null)
    {
        $this->timeSpent = $timeSpent;
        $this->description = $description;
        $this->createdAt = new DateTimeImmutable() ?? $createdAt;
    }

    public function timeSpent(): string
    {
        return $this->timeSpent;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'timeSpent' => $this->timeSpent(),
            'description' => $this->description(),
            'createdAt' => $this->createdAt(),
        ];
    }
}
