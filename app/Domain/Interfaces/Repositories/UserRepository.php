<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\Entities\UserEntity;

/**
 * UserRepository Interface
 *
 * This interface defines the contract for user repository implementations.
 * It provides methods for creating and retrieving user entities.
 */
interface UserRepository
{
    /**
     * Create a new user entity.
     *
     * @param UserEntity $user The user entity to create.
     * @return UserEntity The created user entity.
     */
    public function create(UserEntity $user): UserEntity;
    /**
     * Find a user entity by email.
     *
     * @param string $email The email of the user to find.
     * @return UserEntity|null The found user entity or null if not found.
     */
    public function findByEmail(string $email): ?UserEntity;
    /**
     * Find a user entity by ID.
     *
     * @param int $id The ID of the user to find.
     * @return UserEntity|null The found user entity or null if not found.
     */
    public function findById(int $id): ?UserEntity;
}
