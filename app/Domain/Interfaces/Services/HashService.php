<?php

namespace App\Domain\Interfaces\Services;

use App\Domain\ValueObjects\Password;
use App\Domain\ValueObjects\PasswordHashed;

/**
 * Interface HashService
 * @package App\Domain\Interfaces\Services
 * This interface defines the contract for hashing and verifying passwords.
 */
interface HashService
{
    /**
     * Hash a password.
     *
     * @param string $password The password to hash.
     * @return string The hashed password.
     */
    public function hash(Password $password): string;
    /**
     * Verify a password against a hashed password.
     *
     * @param string $password The password to verify.
     * @param string $hashedPassword The hashed password to compare against.
     * @return bool True if the password matches, false otherwise.
     */
    public function verify(Password $password, PasswordHashed $hashedPassword): bool;
}
