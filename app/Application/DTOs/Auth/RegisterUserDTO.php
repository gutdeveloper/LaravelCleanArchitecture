<?php

namespace App\Application\DTOs\Auth;

/**
 * Data Transfer Object for Register User
 *
 * This class is used to transfer data related to user registration.
 * It contains properties for the user's first name, last name, email, phone, and password.
 */
class RegisterUserDTO
{
    /**
     * Constructor for RegisterUserDTO
     *
     * @param string $first_name The first name of the user.
     * @param string $last_name The last name of the user.
     * @param string $phone The phone number of the user.
     * @param string $email The email of the user.
     * @param string $password The password of the user.
     */
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $password,
    ) {}
}
