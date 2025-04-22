<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Email;

/**
 * Class UserEntity
 * @package App\Domain\Entities
 */
class UserEntity
{
    private string $name;
    private readonly Email $email;
    private readonly string $password;
    private readonly ?int $id;
    /**
     * UserEntity constructor.
     * @param string $name
     * @param Email $email
     * @param string $password
     * @param int|null $id
     */
    public function __construct(string $name, Email $email, string $password, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
    
    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
