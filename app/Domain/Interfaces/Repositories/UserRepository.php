<?php

namespace App\Domain\Interfaces\Repositories;

use App\Application\DTOs\Auth\UserBasicInfoDTO;
use App\Domain\Entities\UserEntity;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Uuid;

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
     * @return UserBasicInfoDTO The created user.
     */
    public function create(UserEntity $user): ?UserBasicInfoDTO;

    /**
     * Find a user entity by email.
     *
     * @param string $email The email of the user to find.
     * @return UserEntity|null The found user entity or null if not found.
     */
    public function findByEmail(Email $email): ?UserEntity;
    
    /**
     * Find a user entity by ID.
     *
     * @param Uuid $id The ID of the user to find.
     * @return UserEntity|null The found user entity or null if not found.
     */
    public function findById(Uuid $id): ?UserEntity;
}
