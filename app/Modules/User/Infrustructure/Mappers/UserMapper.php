<?php

declare(strict_types=1);

namespace App\Modules\User\Infrustructure\Mappers;

use App\Models\User;
use App\Modules\User\Domain\DTO\UserDTO;
use App\Modules\User\Domain\Entities\UserSaveEntity;

class UserMapper
{
    public static function toEntity(
        User $model
    ): UserSaveEntity {
        return new UserSaveEntity(
            id: $model->id,
            userName: $model->name,
            email: $model->email,
            password: null,
            isActive: (bool) $model->is_active,
        );
    }

    public static function toDTO(
        User $model
    ): UserDTO {
        return new UserDTO(
            id: $model->id,
            username: $model->name,
            email: $model->email,
            password: null,
            isActive: (bool) $model->is_active,
        );
    }

    public static function toPersistence(
        UserSaveEntity $entity
    ): array {
        return [
            'id' => $entity->id,
            'name' => $entity->userName,
            'email' => $entity->email,
            'password' => $entity->password,
            'is_active' => $entity->isActive,
        ];
    }
}
