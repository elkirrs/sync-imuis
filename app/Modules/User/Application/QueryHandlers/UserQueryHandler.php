<?php

declare(strict_types=1);

namespace App\Modules\User\Application\QueryHandlers;

use App\Modules\User\Application\Queries\UserQuery;
use App\Modules\User\Domain\DTO\UserDTO;
use App\Modules\User\Domain\Repositories\UserRepository;

final class UserQueryHandler
{
    public function __construct(
        private UserRepository $repo
    ) {}

    public function __invoke(UserQuery $query): ?UserDTO
    {
        return $this->repo->findOne($query->id);
    }
}
