<?php

namespace App\Application\DTOs\Auth;

use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;

/**
 * Data Transfer Object for Login User
 *
 * This class is used to transfer data related to user login.
 * It contains properties for the user's email and password.
 */
class LoginUserDTO
{
    /**
     * Constructor for LoginUserDTO
     *
     * @param Email $email The email of the user.
     * @param Password $password The password of the user.
     */
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {}
}
