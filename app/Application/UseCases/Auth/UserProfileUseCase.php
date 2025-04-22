<?php

namespace App\Application\UseCases\Auth;

use App\Domain\Entities\UserEntity;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Interfaces\Repositories\UserRepository;

/**
 * UserProfileUseCase Class
 *
 * This class handles the retrieval of user profile information.
 * It checks if the user exists and returns the user's profile data.
 */
class UserProfileUseCase
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Execute the retrieval of user profile information.
     *
     * @param int $userId The ID of the user whose profile is to be retrieved.
     * @return array The user's profile data.
     * @throws NotFoundException If the user is not found.
     */
    public function execute($userId)
    {
        $user = $this->userRepository->findById($userId);
        if (!$user) {
            throw new NotFoundException('User not found');
        }
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }
}
