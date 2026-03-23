<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\CommandHandlers;

use App\Modules\Sync\Application\Commands\SyncTaskCommand;
use App\Modules\Sync\Application\Jobs\SyncTaskJob;
use App\Modules\Sync\Domain\Entities\SyncTaskEntity;
use App\Modules\Sync\Domain\Repositories\SyncTaskRepository;
use App\Modules\Sync\Domain\ValueObject\AdministrationId;
use App\Modules\Sync\Domain\ValueObject\Attempts;
use App\Modules\Sync\Domain\ValueObject\DataBaseName;
use App\Modules\Sync\Domain\ValueObject\DateTime;
use App\Modules\Sync\Domain\ValueObject\Name;
use App\Modules\Sync\Domain\ValueObject\Option;
use App\Modules\Sync\Domain\ValueObject\Status;
use App\Modules\Sync\Domain\ValueObject\Uuid;
use App\Modules\Sync\Enums\SyncTaskStatusEnum;
use App\Modules\Sync\Infrastructure\Mappers\SyncTaskMapper;
use Carbon\Carbon;

final class SyncTaskCommandHandler
{
    public function __construct(
        private SyncTaskRepository $repository
    ) {}

    public function __invoke(SyncTaskCommand $command): void
    {
        $entity = new SyncTaskEntity(
            uuid: Uuid::generate(),
            name: Name::generate($command->connectionName, $command->dbName),
            status: new Status(SyncTaskStatusEnum::Waiting->value),
            options: new Option(
                new DataBaseName($command->dbName),
                new AdministrationId($command->connectionId),
            ),
            attempts: new Attempts(0),
            availableAt: new DateTime($command->availableAt),
            createdAt: new DateTime(date('Y-m-d H:i:s')),
        );

        $this->repository->save($entity);

        SyncTaskJob::dispatch(SyncTaskMapper::toDTO($entity))
            ->delay(Carbon::parse($entity->availableAt->value))
            ->onQueue('sync');
    }
}
