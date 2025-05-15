<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\User\GetUserProfileUseCase;
use Illuminate\Support\Facades\Auth;

/**
 * UserController
 * 
 * Controlador para manejar operaciones relacionadas con usuarios.
 */
class UserController
{
    private GetUserProfileUseCase $getUserProfileUseCase;
    
    /**
     * Constructor
     *
     * @param GetUserProfileUseCase $getUserProfileUseCase
     */
    public function __construct(GetUserProfileUseCase $getUserProfileUseCase)
    {
        $this->getUserProfileUseCase = $getUserProfileUseCase;
    }
    
    /**
     * Obtener el perfil del usuario actual
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $userId = Auth::user()->id;        
        $userProfile = $this->getUserProfileUseCase->execute($userId);
        
        return response()->json($userProfile);
    }
} 