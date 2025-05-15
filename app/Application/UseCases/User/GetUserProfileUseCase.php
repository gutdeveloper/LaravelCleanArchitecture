<?php

namespace App\Application\UseCases\User;

use App\Application\DTOs\User\UserProfileDTO;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Interfaces\Repositories\UserRepository;
use App\Domain\ValueObjects\Uuid;

/**
 * GetUserProfileUseCase Class
 *
 * Este caso de uso maneja la obtención de información del perfil de usuario.
 * Verifica si el usuario existe y devuelve los datos del perfil.
 */
class GetUserProfileUseCase
{
    private UserRepository $userRepository;

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Ejecuta la obtención de información del perfil de usuario.
     *
     * @param string $userId El ID del usuario cuyo perfil se va a obtener.
     * @return UserProfileDTO Los datos del perfil del usuario.
     * @throws NotFoundException Si el usuario no se encuentra.
     */
    public function execute(string $userId): UserProfileDTO
    {
        $userUuid = new Uuid($userId);
        $user = $this->userRepository->findById($userUuid);

        if (!$user) throw new NotFoundException('User not found');

        return new UserProfileDTO(
            $user->getId(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail()->value(),
            $user->getPhone()->value(),
            $user->getRole()->value()->value
        );
    }
}
