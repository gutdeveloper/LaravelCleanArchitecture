<?php

namespace App\Domain\ValueObjects;

use App\Domain\Exceptions\BadRequestException;

/**
 * Class Email
 * @package App\Domain\ValueObjects
 * This class represents an email value object.
 * It validates the email format with robust rules including domain validation.
 */
final class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $value = strtolower(trim($value));
        if (empty($value)) {
            throw new BadRequestException("Email cannot be empty");
        }
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new BadRequestException("Invalid email format");
        }

        if (strlen($value) > 50) {
            throw new BadRequestException("Email cannot be longer than 50 characters");
        }
        if (strlen($value) < 5) {
            throw new BadRequestException("Email cannot be shorter than 5 characters");
        }
        

        $domain = substr(strrchr($value, "@"), 1);
        if (!$domain || !checkdnsrr($domain, 'MX')) {
            throw new BadRequestException("Invalid email domain or domain does not exist");
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
