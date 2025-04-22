<?php

namespace App\Infrastructure\Services;

use App\Domain\Interfaces\Services\HashService;

use Illuminate\Support\Facades\Hash;

class BcryptHashService implements HashService
{
    /**
     * Hash a password using Bcrypt.
     *
     * @param string $password
     * @return string
     */
    public function hash(string $password): string
    {
        return Hash::make($password);
    }
    /**
     * Verify a password against a hashed password.
     *
     * @param string $password
     * @param string $hashedPassword
     * @return bool
     */
    public function verify(string $password, string $hashedPassword): bool
    {
        return Hash::check($password, $hashedPassword);
    }
}
