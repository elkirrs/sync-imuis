<?php

declare(strict_types=1);

namespace App\Modules\Connection\Infrastructure\Database;

use Illuminate\Support\Facades\Artisan;

final class MigrationRunner
{
    public function run(
        string $database,
        string $connect = 'tenant'
    ): void {
        $connection = config('database.connections.sqlsrv');

        $connection['database'] = $database;

        config(["database.connections.$connect" => $connection]);

        Artisan::call('migrate', [
            '--database' => $connect,
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ]);
    }
}
