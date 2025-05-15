<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTOs\Auth\UserBasicInfoDTO;
use App\Infrastructure\Mappers\UserMapper;
use App\Domain\Entities\UserEntity;
use App\Domain\Interfaces\Repositories\UserRepository;
use App\Domain\Interfaces\Services\Logger;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Uuid;
use App\Models\User;
use Throwable;

/**
 * EloquentUserRepository Class
 *
 * This class implements the UserRepository interface using Eloquent ORM.
 * It provides methods for creating and retrieving user entities.
 */
class EloquentUserRepository implements UserRepository
{
    private readonly User $model;
    private readonly UserMapper $userMapper;
    private readonly Logger $logger;
    /**
     * Constructor for EloquentUserRepository
     *
     * @param User $model The Eloquent User model instance.
     * @param UserMapper $userMapper The user mapper instance.
     * @param Logger $logger The logger service.
     */
    public function __construct(User $model, UserMapper $userMapper, Logger $logger)
    {
        $this->model = $model;
        $this->userMapper = $userMapper;
        $this->logger = $logger;
    }

    /**
     * Create a new user entity.
     *
     * @param UserEntity $user The user entity to create.
     * @return UserBasicInfoDTO|null The created user entity.
     */
    public function create(UserEntity $user): ?UserBasicInfoDTO
    {
        try {
            $userCreated = $this->model->create([
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail()->value(),
                'phone' => $user->getPhone()->value(),
                'password' => $user->getPassword()->value(),
                'role' => $user->getRole()->value(),
                'active' => $user->isActive(),
            ])->fresh();

            $this->logger->info('User created', ['user' => $userCreated->toArray()]);

            if (!$userCreated) return null;

            return $this->userMapper->toUserBasicInfoDTO($userCreated);
        } catch (Throwable  $e) {
            $this->logger->error('Error creating user', ['exception' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Find a user entity by email.
     *
     * @param Email $email The email of the user to find.
     * @return UserEntity|null The found user entity or null if not found.
     */
    public function findByEmail(Email $email): ?UserEntity
    {
        try {
            $findUser = $this->model->where('email', $email->value())->first();
            
            if (!$findUser) return null;
            
            $user = $this->userMapper->toEntity($findUser);

            return $user;
        } catch (Throwable  $e) {
            $this->logger->error('Error finding user by email', ['exception' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Find a user entity by ID.
     *
     * @param Uuid $id The ID of the user to find.
     * @return UserEntity|null The found user entity or null if not found.
     */
    public function findById(Uuid $id): ?UserEntity
    {
        try {
            $findUser = $this->model->where('id', $id)->first();

            if (!$findUser) return null;

            $user = $this->userMapper->toEntity($findUser);            

            return $user;
        } catch (Throwable  $e) {
            $this->logger->error('Error finding user by id', ['exception' => $e->getMessage()]);
            return null;
        }
    }
}
