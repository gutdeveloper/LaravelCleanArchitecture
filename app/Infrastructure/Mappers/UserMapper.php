<?php

namespace App\Infrastructure\Mappers;

use App\Domain\Entities\UserEntity;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\PasswordHashed;
use App\Domain\ValueObjects\Phone;
use App\Domain\ValueObjects\Role;
use App\Domain\ValueObjects\Uuid;
use App\Models\User;
use App\Application\DTOs\Auth\UserBasicInfoDTO;

final class UserMapper
{
    public function toUserBasicInfoDTO(User $user): UserBasicInfoDTO
    {
        return new UserBasicInfoDTO($user);
    }

    public function toEntity(User $model): UserEntity
    {
        $email = new Email($model->email);
        $phone = new Phone($model->phone);
        $role = Role::from($model->role);
        $password = new PasswordHashed($model->password);
        $id = new Uuid($model->id);

        $entity = new UserEntity(
            $model->first_name,
            $model->last_name,
            $phone,
            $email,
            $password,
            $role,
            $model->active,
            $id
        );

        return $entity;
    }
}
