<?php

declare(strict_types=1);

namespace App\Modules\User\Application\CommandHandlers;

use App\Modules\User\Application\Commands\UserSaveCommand;
use App\Modules\User\Domain\Entities\UserSaveEntity;
use App\Modules\User\Domain\Repositories\UserRepository;

readonly class UserSaveCommandHandler
{
    public function __construct(
        private UserRepository $repo
    ) {}

    public function __invoke(
        UserSaveCommand $command
    ): void {
        $entity = new UserSaveEntity(
            $command->id,
            $command->username,
            $command->email,
            $command->password,
            $command->isActive
        );

        $this->repo->save($entity);
    }
}
