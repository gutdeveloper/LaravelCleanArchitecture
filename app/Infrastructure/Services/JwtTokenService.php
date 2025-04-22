<?php

namespace App\Infrastructure\Services;

use App\Domain\Exceptions\InternalServerException;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Interfaces\Services\TokenService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Domain\Interfaces\Repositories\UserRepository;
use App\Models\User;

/**
 * Class JwtTokenService
 * @package App\Infrastructure\Services
 */
class JwtTokenService implements TokenService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}
    /**
     * Generate a JWT token for the given user ID.
     *
     * @param array $payload
     * @return string
     * @throws NotFoundException
     * @throws InternalServerException
     */
    public function generate(array $payload): string
    {
        $userId = $payload['id'];
        $user = User::find($userId);
        if (!$user) {
            throw new NotFoundException('User not found');
        }
        $token = JWTAuth::fromUser($user);
        if (!$token) {
            throw new InternalServerException('Token generation failed');
        }
        return $token;
    }
}
