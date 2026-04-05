<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\Repositories;

interface SyncRepository
{
    public function setConnection(string $connection): self;

    public function bulkUpsert(iterable $rows, string $tableName, array $uniqueBy): void;

    public function bulkInsert(iterable $rows, string $tableName): void;

    public function merge(
        string $targetTable,
        string $stagingTable,
        array $keys,
        array $columns,
        string $sourceIdColumn,
        int $sourceId
    ): ?array;

    public function delete(string $table, int $sourceId): void;

    public function count(string $table): int;
}
