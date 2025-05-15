<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\Auth\LoginUserDTO;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Exceptions\UnauthorizedException;
use App\Domain\Interfaces\Repositories\UserRepository;
use App\Domain\Interfaces\Services\HashService;
use App\Domain\Interfaces\Services\TokenService;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use App\Domain\ValueObjects\PasswordHashed;

/***
 * LoginUseCase Class
 *
 * This class handles the login functionality for users.
 * It verifies the user's credentials and generates a JWT token.
 * 
 */
class LoginUseCase
{
    private readonly UserRepository $userRepository;
    private readonly HashService $passwordHasher;
    private readonly TokenService $tokenService;

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     * @param HashService $passwordHasher
     * @param TokenService $tokenService
     */
    public function __construct(UserRepository $userRepository, HashService $passwordHasher, TokenService $tokenService)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->tokenService = $tokenService;
    }

    /**
     * Execute the login use case.
     *
     * @param LoginUserDTO $dto
     * @return string The generated JWT token.
     * @throws NotFoundException If the user is not found.
     * @throws UnauthorizedException If the credentials are invalid.
     */
    public function execute(LoginUserDTO $dto): string
    {
        $email = new Email($dto->email);
        $user = $this->userRepository->findByEmail($email);

        if (!$user) throw new NotFoundException("User not found");

        $password = new Password($dto->password);
        $passwordHashed = new PasswordHashed($user->getPassword()->value());
        $passwordVerification = $this->passwordHasher->verify($password, $passwordHashed);

        if (!$passwordVerification) throw new UnauthorizedException("Invalid credentials");

        $token = $this->tokenService->generate(['id' => $user->getId()]);
        return $token;
    }
}