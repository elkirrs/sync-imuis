<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\CommandHandlers;

use App\Modules\Connection\Application\Commands\ConnectionCreateTenantCommand;
use App\Modules\Connection\Application\Services\CreateTenantDataBaseService;
use App\Modules\Connection\Domain\Repositories\ConnectionRepository;
use RuntimeException;
use Throwable;

readonly class ConnectionCreateTenantCommandHandler
{
    public function __construct(
        private ConnectionRepository $repo,
        private CreateTenantDataBaseService $dbService,
    ) {}

    /**
     * @throws Throwable
     */
    public function __invoke(
        ConnectionCreateTenantCommand $command
    ): void {

        $entity = $this->repo->findOne($command->id);

        try {

            if ($entity->isCreatedDB->value) {
                return;
            }

            $this->dbService->createForConnection($entity);

            $entity->createdDB(true);

            $this->repo->save($entity);
        } catch (Throwable $th) {

            if ((int)$th->getCode() === 42000) {
                $entity->createdDB(true);
                $this->repo->save($entity);

                throw new RuntimeException('Database was created');
            }

            throw $th;
        }
    }
}
