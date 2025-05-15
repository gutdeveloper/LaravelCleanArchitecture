<?php

namespace App\Domain\ValueObjects;

use App\Domain\Exceptions\BadRequestException;

/**
 * Class Password
 * @package App\Domain\ValueObjects
 * This class represents a password value object.
 * It validates the password format and ensures it meets certain criteria.
 */
final class Password
{
    private string $value;
    public function __construct(string $value)
    {
        $value = trim($value);
        if (empty($value)) {
            throw new BadRequestException("Password cannot be empty");
        }
        if (strlen($value) < 6) {
            throw new BadRequestException("Password must be at least 8 characters long");
        }
        if (!preg_match('/[A-Z]/', $value)) {
            throw new BadRequestException("Password must contain at least one uppercase letter");
        }
        if (!preg_match('/[a-z]/', $value)) {
            throw new BadRequestException("Password must contain at least one lowercase letter");
        }
        if (!preg_match('/[0-9]/', $value)) {
            throw new BadRequestException("Password must contain at least one number");
        }
        if (!preg_match('/[\W_]/', $value)) {
            throw new BadRequestException("Password must contain at least one special character");
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
