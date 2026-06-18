<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\CommandHandlers;

use App\Modules\Sync\Application\Commands\SyncChangeStatusCommand;
use App\Modules\Sync\Domain\Repositories\SyncTaskRepository;
use App\Modules\Sync\Enums\SyncTaskStatusEnum;
use App\Shared\Domain\Cache\CacheStorage;
use DomainException;

final readonly class SyncChangeStatusCommandHandler
{
    public function __construct(
        private SyncTaskRepository $syncTaskRepository,
        private CacheStorage $cache,
    ) {}

    public function __invoke(SyncChangeStatusCommand $command): void
    {
        $entitySyncTask = $this->syncTaskRepository->findByStatus($command->currentStatus->value);

        foreach ($entitySyncTask as $entity) {
            match ($command->chooseStatus) {
                SyncTaskStatusEnum::Created => $entity->created(),
                SyncTaskStatusEnum::Waiting => $entity->waiting(),
                SyncTaskStatusEnum::Started => $entity->start(),
                SyncTaskStatusEnum::Processing => $entity->processing(),
                SyncTaskStatusEnum::Finished => $entity->finished(),
                SyncTaskStatusEnum::Failed => $entity->failed(),
                SyncTaskStatusEnum::Duplicate => $entity->duplicate(),
                default => throw new DomainException('Unknown status')
            };

            $isRunnig = $this->cache->getValue($entity->uuid->value);

            if ($isRunnig) {
                continue;
            }

            // if the rows will be a lot, than it will be better to do bulk update (upsert)
            $this->syncTaskRepository->save($entity);
        }
    }
}
