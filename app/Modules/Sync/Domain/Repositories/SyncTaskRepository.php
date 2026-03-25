<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\Repositories;

use App\Modules\Sync\Domain\Entities\SyncTaskEntity;

interface SyncTaskRepository
{
    public function save(SyncTaskEntity $entity): void;

    public function bulkUpsert(iterable $rows, string $tableName, array $uniqueBy): void;

    public function getSyncTask(): array;

    public function findOne(string $uuid): SyncTaskEntity;

    public function setConnection(string $connection): self;
}
