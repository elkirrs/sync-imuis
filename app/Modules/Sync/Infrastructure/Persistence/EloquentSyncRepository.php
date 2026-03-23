<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Persistence;

use App\Modules\Sync\Domain\Repositories\SyncRepository;
use App\Shared\Infrastructure\Persistence\BulkInsert;
use App\Shared\Infrastructure\Persistence\BulkUpsert;
use Illuminate\Support\Facades\DB;

final class EloquentSyncRepository implements SyncRepository
{
    public function __construct(
        protected BulkUpsert $bulkUpsert,
        protected BulkInsert $bulkInsert
    ) {}

    public function bulkUpsert(
        iterable $rows,
        string $tableName,
        array $uniqueBy
    ): void {

        $arrays = (function () use ($rows) {

            foreach ($rows as $row) {
                yield $row->toArray();
            }

        })();

        $rows = collect($arrays)
            ->unique(function ($row) use ($uniqueBy) {
                return implode('.', array_map(fn ($col) => $row[$col] ?? '', $uniqueBy));
            })
            ->values()
            ->all();

        $this->bulkUpsert->execute(
            table: $tableName,
            rows: $rows,
            uniqueBy: $uniqueBy
        );
    }

    public function bulkInsert(
        iterable $rows,
        string $tableName
    ): void {
        $arrays = (function () use ($rows) {

            foreach ($rows as $row) {
                yield $row->toArray();
            }

        })();

        $this->bulkInsert->setLimitInsertBulk(2100);

        $this->bulkInsert->execute(
            table: $tableName,
            rows: $arrays,
        );
    }

    public function merge(
        string $targetTable,
        string $stagingTable,
        array $keys,
        array $columns,
        string $sourceIdColumn,
        int $sourceId
    ): ?array {

        $onConditions = collect($keys)
            ->map(fn ($k) => "target.$k = source.$k")
            ->implode(' AND ');

        $updateColumns = collect($columns)
            ->filter(fn ($c) => ! in_array($c, $keys))
            ->map(fn ($c) => "$c = source.$c")
            ->implode(', ');

        $insertColumns = implode(', ', $columns);

        $insertValues = collect($columns)
            ->map(fn ($c) => "source.$c")
            ->implode(', ');

        //        $mergeSql = '
        //            MERGE '.$targetTable.' AS target
        //            USING '.$stagingTable.' AS source
        //            ON '.$onConditions.'
        //            WHEN MATCHED AND target.hash <> source.hash THEN
        //                UPDATE SET
        //                    '.$updateColumns.'
        //            WHEN NOT MATCHED BY TARGET THEN
        //                INSERT ('.$insertColumns.')
        //                VALUES ('.$insertValues.')
        //            WHEN NOT MATCHED BY SOURCE AND target.'.$sourceIdColumn.' = ?
        //                THEN DELETE;
        //        ';
        //        DB::statement($mergeSql, [$sourceId]);

        $mergeSql = '
                    MERGE '.$targetTable.' AS target
                    USING '.$stagingTable.' AS source
                    ON '.$onConditions.'
                    WHEN MATCHED AND target.hash <> source.hash THEN
                        UPDATE SET
                            '.$updateColumns.'
                    WHEN NOT MATCHED BY TARGET THEN
                        INSERT ('.$insertColumns.')
                        VALUES ('.$insertValues.')
                    OUTPUT $action, inserted.id AS inserted_id;
                ';

        $results = DB::select($mergeSql, [$sourceId]);

        $data = [
            'insert' => 0,
            'update' => 0,
            'delete' => 0,
        ];

        foreach ($results as $row) {
            switch ($row->{'$action'}) {
                case 'INSERT':
                    $data['insert']++;
                    break;
                case 'UPDATE':
                    $data['update']++;
                    break;
                case 'DELETE':
                    $data['delete']++;
                    break;
            }
        }

        return $data;
    }

    public function delete(
        string $table,
        int $sourceId
    ): void {

        DB::table($table)->where('connect_id', '=', $sourceId)->delete();
    }
}
