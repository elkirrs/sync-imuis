<?php

declare(strict_types=1);

namespace app\Modules\Sync\Infrastructure\Persistence;

use App\Models\SyncDetail;
use App\Modules\Sync\Domain\Entities\SyncTaskDetailEntity;
use App\Modules\Sync\Domain\Repositories\SyncTaskDetailRepository;
use App\Modules\Sync\Infrastructure\Mappers\SyncDetailMapper;

final readonly class EloquentSyncTaskDetailRepository implements SyncTaskDetailRepository
{
    public function __construct(
        private SyncDetail $model
    ) {}

    public function save(SyncTaskDetailEntity $entity): void
    {
        $this->model::query()
            ->insert(SyncDetailMapper::toPersistence($entity));
    }

    public function findOne(
        string $uuid,
        string $field = 'uuid'
    ): ?SyncTaskDetailEntity {

        $model = $this->model::query()
            ->where($field, '=', $uuid)
            ->first();

        return SyncDetailMapper::toEntity($model);
    }

    public function findBy(string $uuid, string $field = 'uuid'): array
    {
        return $this->model::query()
            ->where($field, '=', $uuid)
            ->orderBy('created_at', 'ASC')
            ->get()
            ->map(fn ($model) => SyncDetailMapper::toEntity($model))
            ->toArray();
    }
}
