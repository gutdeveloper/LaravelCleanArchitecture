<?php

namespace App\Infrastructure\Http\Controllers;

use App\Infrastructure\Http\Requests\RegisterRequest;
use App\Infrastructure\Http\Requests\LoginRequest;
use App\Application\UseCases\Auth\RegisterUseCase;
use App\Application\DTOs\Auth\RegisterUserDTO;
use App\Application\DTOs\Auth\LoginUserDTO;
use App\Application\UseCases\Auth\LoginUseCase;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    private RegisterUseCase $registerUseCase;
    private LoginUseCase $loginUseCase;
    
    /**
     * Constructor
     *
     * @param RegisterUseCase $registerUseCase
     * @param LoginUseCase $loginUseCase
     */
    public function __construct(
        RegisterUseCase $registerUseCase,
        LoginUseCase $loginUseCase
    ) {
        $this->loginUseCase = $loginUseCase;
        $this->registerUseCase = $registerUseCase;
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
            $values['first_name'],
            $values['last_name'],
            $values['email'],
            $values['phone'],
            $values['password']
        );
        $userId = $this->registerUseCase->execute($dto);
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $userId,
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
}
