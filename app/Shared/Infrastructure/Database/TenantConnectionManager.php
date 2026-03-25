<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database;

use Illuminate\Support\Facades\DB;

final class TenantConnectionManager
{
    public function connect(
        string $database
    ): void {
        $connection = config('database.connections.sqlsrv');

        $connection['database'] = $database;

        config(['database.connections.tenant' => $connection]);

        DB::purge('tenant');
        DB::reconnect('tenant');
    }
}
