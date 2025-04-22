<?php

namespace App\Application\DTOs;
/**
 * Data Transfer Object for Register User
 *
 * This class is used to transfer data related to user registration.
 * It contains properties for the user's name, email, and password.
 */
class RegisterUserDTO
{
    /**
     * Constructor for RegisterUserDTO
     *
     * @param string $name The name of the user.
     * @param string $email The email of the user.
     * @param string $password The password of the user.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {}
}
