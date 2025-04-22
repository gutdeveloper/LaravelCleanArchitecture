<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\UserEntity;
use App\Domain\Interfaces\Repositories\UserRepository;
use App\Models\User; // Assuming you have a User model in your application
use App\Domain\ValueObjects\Email;

/**
 * Class EloquentUserRepository
 * @package App\Infrastructure\Repositories
 * This class implements the UserRepository interface using Eloquent ORM.
 */
class EloquentUserRepository implements UserRepository
{
    protected $model;
    /**
     * EloquentUserRepository constructor.
     * @param User $model
     */
    public function __construct()
    {
        $this->model = new User();
    }
    /**
     * Create a new user.
     *
     * @param UserEntity $user
     * @return UserEntity
     */
    public function create(UserEntity $user): UserEntity
    {
        $userModel = $this->model->create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);

        return new UserEntity(
            $userModel->name,
            new Email($userModel->email),
            $userModel->password,
            $userModel->id
        );
    }
    /**
     * Update an existing user.
     *
     * @param UserEntity $user
     * @return UserEntity
     */
    public function findByEmail(string $email): ?UserEntity
    {
        $user = $this->model->where('email', $email)->first();
        if (!$user) {
            return null;
        }
        $userEntity = new UserEntity($user->name, new Email($user->email), $user->password, $user->id);
        return $userEntity;
    }
    /**
     * Find a user by ID.
     *
     * @param int $id
     * @return UserEntity|null
     */
    public function findById(int $id): ?UserEntity
    {
        $user = $this->model->where('id', $id)->first();
        if (!$user) {
            return null;
        }
        $userEntity = new UserEntity($user->name, new Email($user->email), $user->password, $user->id);
        return $userEntity;
    }
}
