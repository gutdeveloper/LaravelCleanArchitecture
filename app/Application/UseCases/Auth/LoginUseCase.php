<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\LoginUserDTO;
use App\Domain\Entities\UserEntity;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Exceptions\UnauthorizedException;
use App\Domain\Interfaces\Repositories\UserRepository;
use App\Domain\Interfaces\Services\HashService;
use App\Domain\Interfaces\Services\TokenService;
use App\Domain\ValueObjects\Email;

use Illuminate\Support\Facades\Log;

/***
 * LoginUseCase Class
 *
 * This class handles the login functionality for users.
 * It verifies the user's credentials and generates a JWT token.
 * 
 */
class LoginUseCase
{
    private UserRepository $userRepository;
    private HashService $passwordHasher;
    private TokenService $tokenService;

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
     * Execute the login use case
     *
     * @param LoginUserDTO $dto
     * @return string JWT token
     * @throws NotFoundException if user is not found
     * @throws UnauthorizedException if credentials are invalid
     */
    public function execute(LoginUserDTO $dto): string
    {
        $email = new Email($dto->email);
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw new NotFoundException("User not found");
        }
        $passwordVerification = $this->passwordHasher->verify($dto->password, $user->getPassword());
        if (!$passwordVerification) {
            throw new UnauthorizedException("Invalid credentials");
        }
        $token = $this->tokenService->generate(['id' => $user->getId()]);
        return $token;
    }
}
