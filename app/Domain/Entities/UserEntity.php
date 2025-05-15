<?php

namespace App\Domain\Entities;

use App\Domain\Enums\Roles;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\PasswordHashed;
use App\Domain\ValueObjects\Phone;
use App\Domain\ValueObjects\Role;
use App\Domain\ValueObjects\Uuid;

/**
 * UserEntity Class
 *
 * This class represents a user entity in the system.
 * It contains user information such as name, email, phone,
 * password, role, and active status.
 */
class UserEntity
{
    public readonly string $first_name;
    public readonly string $last_name;
    private readonly Phone $phone;
    private readonly Email $email;
    private readonly PasswordHashed $password;
    private readonly ?Uuid $id;
    private readonly Role $role;
    private readonly bool $active;

    public function __construct(
        string $first_name,
        string $last_name,
        Phone $phone,
        Email $email,
        PasswordHashed $password,
        ?Role $role = null,
        bool $active = true,
        ?Uuid $id = null,
    ) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
        $this->role =  $role ?? Role::from(Roles::USER);
        $this->active = $active;
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }
    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function getPassword(): PasswordHashed
    {
        return $this->password;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}
