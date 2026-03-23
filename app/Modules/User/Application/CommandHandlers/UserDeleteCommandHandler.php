<?php

declare(strict_types=1);

namespace App\Modules\User\Application\CommandHandlers;

use App\Modules\User\Application\Commands\UserDeleteCommand;
use App\Modules\User\Domain\Entities\UserSaveEntity;
use App\Modules\User\Domain\Repositories\UserRepository;

readonly class UserDeleteCommandHandler
{
    public function __construct(
        private UserRepository $repo
    ) {}

    public function __invoke(
        UserDeleteCommand $command
    ): void {
        $entity = new UserSaveEntity(
            id: $command->id,
            userName: '',
            email: '',
            password: '',
            isActive: true,
        );

        $this->repo->delete($entity);
    }
}
