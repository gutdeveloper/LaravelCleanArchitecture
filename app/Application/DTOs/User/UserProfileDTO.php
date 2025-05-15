<?php

namespace App\Application\DTOs\User;

/**
 * Data Transfer Object for User Profile
 *
 * Este DTO se utiliza para transferir información detallada del perfil de usuario.
 * Contiene propiedades para el ID, nombre, apellido, email, teléfono y rol del usuario.
 */
class UserProfileDTO
{
    public string $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $phone;
    public string $role;

    /**
     * Constructor
     *
     * @param string $id
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $phone
     * @param string $role
     */
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
    
    /**
     * Obtiene el nombre completo del usuario
     *
     * @return string
     */
    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
} 