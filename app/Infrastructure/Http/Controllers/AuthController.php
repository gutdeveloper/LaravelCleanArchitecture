<?php

namespace App\Infrastructure\Http\Controllers;

use App\Infrastructure\Http\Requests\RegisterRequest;
use App\Infrastructure\Http\Requests\LoginRequest;
use App\Application\UseCases\Auth\RegisterUseCase;
use App\Application\DTOs\RegisterUserDTO;
use App\Application\DTOs\LoginUserDTO;
use App\Application\UseCases\Auth\LoginUseCase;
use App\Application\UseCases\Auth\UserProfileUseCase;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    private RegisterUseCase $registerUseCase;
    private LoginUseCase $loginUseCase;
    private UserProfileUseCase $userProfileUseCase;
    /**
     * Constructor
     *
     * @param RegisterUseCase $registerUseCase
     * @param LoginUseCase $loginUseCase
     * @param UserProfileUseCase $userProfileUseCase
     */
    public function __construct(
        RegisterUseCase $registerUseCase,
        LoginUseCase $loginUseCase,
        UserProfileUseCase $userProfileUseCase
    ) {
        $this->loginUseCase = $loginUseCase;
        $this->registerUseCase = $registerUseCase;
        $this->userProfileUseCase = $userProfileUseCase;
    }
    /**
     * Register a new user
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $values = $request->validated();
        $dto = new RegisterUserDTO(
            $values['name'],
            $values['email'],
            $values['password']
        );
        $userId = $this->registerUseCase->execute($dto);
        return response()->json([
            'message' => 'User registered successfully',
            'id' => $userId,
        ]);
    }
    /**
     * Login a user
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $values = $request->validated();
        $dto = new LoginUserDTO(
            $values['email'],
            $values['password']
        );
        $token = $this->loginUseCase->execute($dto);
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }
    /**
     * Get user profile
     *
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $userId = Auth::user()->id;
        $user = $this->userProfileUseCase->execute($userId);
        return response()->json(
            $user,
        );
    }
}
