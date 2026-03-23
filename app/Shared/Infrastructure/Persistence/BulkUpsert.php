<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class BulkUpsert
{
    protected int $limitBulk = 2100;

    public function execute(
        string $table,
        iterable $rows,
        array $uniqueBy,
        ?array $updateColumns = null,
        int $chunk = 500
    ): void {

        $buffer = [];

        $newChunk = 0;

        foreach ($rows as $row) {
            if ($newChunk === 0) {
                $newChunk = Helper::BulkWithLimit(count($row), $this->limitBulk, $chunk);
            }

            $buffer[] = $row;

            if (count($buffer) >= $newChunk) {
                $this->flush($table, $buffer, $uniqueBy, $updateColumns);
                $buffer = [];
            }
        }

        if ($buffer) {
            $this->flush($table, $buffer, $uniqueBy, $updateColumns);
        }
    }

    private function flush(
        string $table,
        array $buffer,
        array $uniqueBy,
        ?array $updateColumns
    ): void {

        $updateColumns = $updateColumns
            ?? array_diff(array_keys($buffer[0]), $uniqueBy);

        DB::table($table)->upsert(
            $buffer,
            $uniqueBy,
            $updateColumns
        );

    }
}
