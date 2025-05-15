<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\Auth\RegisterUserDTO;
use App\Application\DTOs\Auth\UserBasicInfoDTO;
use App\Domain\Entities\UserEntity;
use App\Domain\Exceptions\ConflictException;
use App\Domain\Exceptions\InternalServerException;
use App\Domain\Interfaces\Repositories\UserRepository;
use App\Domain\Interfaces\Services\HashService;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use App\Domain\ValueObjects\PasswordHashed;
use App\Domain\ValueObjects\Phone;
use App\Infrastructure\Mappers\UserMapper;
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
    private readonly UserRepository $userRepository;
    private readonly HashService $passwordHasher;
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
    public function execute(RegisterUserDTO $dto): UserBasicInfoDTO
    {
        $email = new Email($dto->email);
        $existingUser = $this->userRepository->findByEmail($email);

        if ($existingUser) throw new ConflictException("User already exists");

        $password = new Password($dto->password);
        $hashedPassword = $this->passwordHasher->hash($password);

        $user = new UserEntity(
            $dto->first_name,
            $dto->last_name,
            new Phone($dto->phone),
            $email,
            new PasswordHashed($hashedPassword),
        );

        $userCreated = $this->userRepository->create($user);

        if (!$userCreated) throw new InternalServerException("User registration failed");

        return $userCreated;
    }
}
