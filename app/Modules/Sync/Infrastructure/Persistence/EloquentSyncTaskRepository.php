<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Persistence;

use App\Models\Sync;
use App\Modules\Sync\Domain\Entities\SyncTaskEntity;
use App\Modules\Sync\Domain\Repositories\SyncTaskRepository;
use App\Modules\Sync\Enums\SyncTaskStatusEnum;
use App\Modules\Sync\Infrastructure\Mappers\SyncTaskMapper;
use App\Shared\Infrastructure\Persistence\BulkUpsert;

final class EloquentSyncTaskRepository implements SyncTaskRepository
{
    public function __construct(
        protected Sync $repository,
        protected BulkUpsert $bulk
    ) {}

    public function save(
        SyncTaskEntity $entity
    ): void {

        $this->repository->query()
            ->updateOrCreate(
                ['uuid' => $entity->uuid->value],
                SyncTaskMapper::toPersistence($entity)
            );
    }

    public function bulkUpsert(
        iterable $rows,
        string $tableName,
        array $uniqueBy
    ): void {
        $arrays = (function () use ($rows) {
            foreach ($rows as $row) {
                yield SyncTaskMapper::toPersistence($row);
            }
        })();

        $this->bulk->execute(
            table: $tableName,
            rows: $arrays,
            uniqueBy: $uniqueBy
        );
    }

    public function getSyncTask(): array
    {
        return $this->repository->query()
            ->whereIn('status', [
                SyncTaskStatusEnum::Created->value,
            ])
            ->get()
            ->map(fn ($model) => SyncTaskMapper::toEntity($model))
            ->all();
    }

    public function findOne(string $uuid): SyncTaskEntity
    {
        $model = $this->repository->query()
            ->where('uuid', '=', $uuid)
            ->first();

        return SyncTaskMapper::toEntity($model);
    }
}
