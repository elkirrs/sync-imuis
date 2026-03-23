<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\Repositories;

use App\Modules\Sync\Domain\Entities\SyncTaskDetailEntity;

interface SyncTaskDetailRepository
{
    public function save(SyncTaskDetailEntity $entity): void;

    public function findOne(string $uuid, string $field = 'uuid'): ?SyncTaskDetailEntity;

    /**
     * @return array []SyncTaskDetailEntity
     */
    public function findBy(string $uuid, string $field = 'uuid'): array;
}
