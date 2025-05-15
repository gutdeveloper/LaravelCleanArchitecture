<?php

namespace App\Application\DTOs\Auth;

use App\Models\User;

/**
 * Data Transfer Object for User Basic Information
 *
 * This class is used to transfer basic user information.
 * It contains properties for the user's ID, first name, last name, email, phone, and role.
 */
class UserBasicInfoDTO
{
    public string $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $phone;
    public string $role;

    public function __construct(
        string $id,
        string $first_name,
        string $last_name,
        string $email,
        string $phone,
        string $role
    ) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
    }
}
