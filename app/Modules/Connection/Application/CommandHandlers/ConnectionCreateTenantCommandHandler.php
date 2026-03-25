<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\CommandHandlers;

use App\Modules\Connection\Application\Commands\ConnectionCreateTenantCommand;
use App\Modules\Connection\Application\Services\CreateTenantDataBaseService;
use App\Modules\Connection\Domain\Repositories\ConnectionRepository;

readonly class ConnectionCreateTenantCommandHandler
{
    public function __construct(
        private ConnectionRepository $repo,
        private CreateTenantDataBaseService $dbService,
    ) {}

    public function __invoke(
        ConnectionCreateTenantCommand $command
    ): void {

        $entity = $this->repo->findOne($command->id);

        if ($entity->isCreatedDB->value) {
            return;
        }

        $this->dbService->createForConnection($entity);

        $entity->createdDB(true);

        $this->repo->save($entity);
    }
}
