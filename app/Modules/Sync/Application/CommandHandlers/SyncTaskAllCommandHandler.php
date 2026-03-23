<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\CommandHandlers;

use App\Modules\Connection\Domain\Repositories\ConnectionReadRepository;
use App\Modules\Sync\Application\Commands\SyncTaskAllCommand;
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

final readonly class SyncTaskAllCommandHandler
{
    public function __construct(
        private ConnectionReadRepository $connectionReadRepository,
        private SyncTaskRepository $repository
    ) {}

    public function __invoke(SyncTaskAllCommand $command): void
    {
        $rows = (function () use ($command) {
            $seconds = 0;
            foreach ($this->connectionReadRepository->findAllActive() as $connectionRead) {
                $tables = $connectionRead?->options?->tables?->value ?? [];

                foreach ($tables as $table) {
                    $entity = new SyncTaskEntity(
                        uuid: Uuid::generate(),
                        name: Name::generate($connectionRead->name->value, $table),
                        status: new Status(SyncTaskStatusEnum::Created->value),
                        options: new Option(
                            new DataBaseName($table),
                            new AdministrationId($connectionRead->id->value),
                        ),
                        attempts: new Attempts(0),
                        availableAt: DateTime::generate($command->dateTimeStart, $seconds),
                        createdAt: new DateTime(date('Y-m-d H:i:s')),
                    );

                    $seconds += 5;
                    yield $entity;
                }
            }
        })();

        $this->repository->bulkUpsert($rows, 'sync', ['uuid']);
    }
}
