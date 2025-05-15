<?php

namespace App\Domain\ValueObjects;

class Uuid
{
    public function __construct(
        public readonly string $uuid,
    ) {
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $uuid)) {
            throw new \InvalidArgumentException("Invalid UUID format");
        }
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

    public function value(): string
    {
        return $this->uuid;
    }
}
