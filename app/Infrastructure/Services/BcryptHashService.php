<?php

namespace App\Infrastructure\Services;

use App\Domain\Exceptions\InternalServerException;
use App\Domain\Interfaces\Services\HashService;
use App\Domain\ValueObjects\Password;
use App\Domain\ValueObjects\PasswordHashed;
use Illuminate\Support\Facades\Hash;

class BcryptHashService implements HashService
{
    /**
     * Hash a password using Bcrypt.
     *
     * @param string $password
     * @return string
     */
    public function hash(Password $password): string
    {
        $hashedPassword = Hash::make($password);
        if (!$hashedPassword) {
            throw new InternalServerException('Failed to hash password');
        }
        return $hashedPassword;
    }
    /**
     * Verify a password against a hashed password.
     *
     * @param string $password
     * @param string $hashedPassword
     * @return bool
     */
    public function verify(Password $password, PasswordHashed $hashedPassword): bool
    {
        return Hash::check($password, $hashedPassword);
    }
}
