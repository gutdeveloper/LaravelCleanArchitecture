<?php

namespace App\Application\DTOs;
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
     * @param string $email The email of the user.
     * @param string $password The password of the user.
     */
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {}
}
