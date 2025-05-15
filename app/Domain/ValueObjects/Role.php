<?php

namespace App\Domain\ValueObjects;

use App\Domain\Enums\Roles;
use App\Domain\Exceptions\BadRequestException;

/**
 * Class Role
 * @package App\Domain\ValueObjects
 * This class represents a role value object.
 * It validates the role format and ensures it meets certain criteria.
 */
final class Role
{
    private Roles $value;

    private function __construct(Roles $value)
    {
        $this->value = $value;
    }

    /**
     * Factory method to create a Role object.
     *
     * @param string|Roles $value
     * @return self
     * @throws BadRequestException
     */
    public static function from(string|Roles $value): self
    {
        if (is_string($value)) {
            $enum = Roles::tryFrom($value);
            if (!$enum) {
                throw new BadRequestException("Invalid role: $value");
            }
            return new self($enum);
        }

        return new self($value);
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function value(): Roles
    {
        return $this->value;
    }
}
