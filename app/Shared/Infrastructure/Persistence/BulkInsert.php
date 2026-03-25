<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

final class BulkInsert
{
    protected int $limitBulk = 2100;

    public function setLimitInsertBulk(
        int $limitInsertBulk
    ): void {
        $this->limitBulk = $limitInsertBulk;
    }

    public function execute(
        string $connect,
        string $table,
        iterable $rows,
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
                $this->flush($connect, $table, $buffer);
                $buffer = [];
            }
        }

        if ($buffer) {
            $this->flush($connect, $table, $buffer);
        }
    }

    private function flush(
        string $connect,
        string $table,
        array $buffer,
    ): void {

        DB::connection($connect)
            ->table($table)
            ->insert($buffer);
    }
}
