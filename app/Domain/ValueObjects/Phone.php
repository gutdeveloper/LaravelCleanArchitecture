<?php

namespace App\Domain\ValueObjects;

use App\Domain\Exceptions\BadRequestException;

/**
 * Class Phone
 * @package App\Domain\ValueObjects
 * This class represents a phone number value object.
 * It validates the phone number format and ensures it meets certain criteria.
 */
final class Phone
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);
        if (empty($value)) {
            throw new BadRequestException("Phone number cannot be empty");
        }
        if (!preg_match('/^\+?[0-9]{1,4}?[0-9]{7,14}$/', $value)) {
            throw new BadRequestException("Invalid phone number format");
        }
        if (strlen($value) < 7 || strlen($value) > 15) {
            throw new BadRequestException("Phone number must be between 7 and 15 digits long");
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
