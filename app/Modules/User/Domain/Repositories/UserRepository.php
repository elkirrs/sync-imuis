<?php

declare(strict_types=1);

namespace App\Modules\User\Domain\Repositories;

use App\Modules\User\Domain\DTO\UserDTO;
use App\Modules\User\Domain\Entities\UserSaveEntity;

interface UserRepository
{
    public function save(UserSaveEntity $entity): void;

    public function findOne(int $id): ?UserDTO;

    public function delete(UserSaveEntity $entity): void;
}
