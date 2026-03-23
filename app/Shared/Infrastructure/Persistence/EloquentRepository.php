<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;

abstract class EloquentRepository
{
    protected function transaction(
        callable $callback
    ) {
        return DB::transaction($callback);
    }

    protected function upsert(
        string $table,
        array $rows,
        array $uniqueBy,
        array $updateColumns
    ): void {
        DB::table($table)->upsert(
            $rows,
            $uniqueBy,
            $updateColumns
        );
    }
}
