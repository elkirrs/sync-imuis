<?php

declare(strict_types=1);

namespace App\Modules\Connection\Infrastructure\Database;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

final class RollbackRunner
{
    public function run(
        string $database,
        int $steps = 0,
        string $connect = 'tenant'
    ): void {
        $connection = config('database.connections.sqlsrv');

        $connection['database'] = $database;

        config(["database.connections.$connect" => $connection]);

        DB::purge($connect);
        DB::reconnect($connect);

        $params = [
            '--database' => $connect,
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ];

        if ($steps > 0) {
            $params['--step'] = $steps;
        }

        Artisan::call('migrate:rollback', $params);
    }
}
