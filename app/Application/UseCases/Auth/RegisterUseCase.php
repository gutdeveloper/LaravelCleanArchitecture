<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\RegisterUserDTO;
use App\Domain\Entities\UserEntity;
use App\Domain\Exceptions\ConflictException;
use App\Domain\Exceptions\InternalServerException;
use App\Domain\Interfaces\Repositories\UserRepository;
use App\Domain\Interfaces\Services\HashService;
use App\Domain\ValueObjects\Email;
use Illuminate\Support\Facades\Log;

/**
 * RegisterUseCase Class
 *
 * This class handles the registration of a new user.
 * It checks if the user already exists, hashes the password,
 * and creates a new user entity.
 * 
 */
class RegisterUseCase
{

    private UserRepository $userRepository;
    private HashService $passwordHasher;

    /**
     * Constructor for RegisterUseCase
     *
     * @param UserRepository $userRepository The user repository instance.
     * @param HashService $passwordHasher The password hasher instance.
     */
    public function __construct(UserRepository $userRepository, HashService $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }
    /**
     * Execute the registration of a new user.
     *
     * @param RegisterUserDTO $dto The data transfer object containing user registration data.
     * @return UserEntity The created user entity.
     * @throws ConflictException If the user already exists.
     * @throws InternalServerException If user registration fails.
     */
    public function execute(RegisterUserDTO $dto): int
    {
        $email = new Email($dto->email);
        $user = $this->userRepository->findByEmail($email);
        if ($user) {
            throw new ConflictException("User already exists");
        }
        $hashedPassword = $this->passwordHasher->hash($dto->password);
        $user = new UserEntity($dto->name, $email, $hashedPassword);
        $user = $this->userRepository->create($user);
        if (!$user) {
            throw new InternalServerException("User registration failed");
        }
        return $user->getId();
    }
}
