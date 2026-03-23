<?php

declare(strict_types=1);

namespace App\Modules\User\Infrustructure\Persistence;

use App\Models\User;
use App\Modules\User\Domain\DTO\UserDTO;
use App\Modules\User\Domain\Entities\UserSaveEntity;
use App\Modules\User\Domain\Repositories\UserRepository;
use App\Modules\User\Infrustructure\Mappers\UserMapper;

class EloquentUserRepository implements UserRepository
{
    public function __construct(
        private User $user
    ) {}

    public function save(UserSaveEntity $entity): void
    {
        $this->user->query()
            ->updateOrCreate(
                ['id' => $entity->id],
                UserMapper::toPersistence($entity)
            );
    }

    public function findOne(int $id): ?UserDTO
    {
        $model = $this->user->query()
            ->where('id', '=', $id)
            ->first();

        return UserMapper::toDTO($model);
    }

    public function delete(UserSaveEntity $entity): void
    {
        $this->user->query()
            ->where('id', '=', $entity->id)
            ->delete();
    }
}
