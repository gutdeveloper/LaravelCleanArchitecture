<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

/**
 * Class Email
 * @package App\Domain\ValueObjects
 * This class represents an email value object.
 * It validates the email format and ensures it is not longer than 50 characters.
 */
final class Email
{
    private string $value;
    
    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format");
        }
        if (strlen($value) > 50) {
            throw new InvalidArgumentException("Email cannot be longer than 30 characters");
        }
        $this->value = strtolower($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    // public function value(): string
    // {
    //     return $this->value;
    // }
}
