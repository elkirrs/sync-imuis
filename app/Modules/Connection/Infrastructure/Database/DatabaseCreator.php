<?php

declare(strict_types=1);

namespace App\Modules\Connection\Infrastructure\Database;

use Illuminate\Support\Facades\DB;

final class DatabaseCreator
{
    public function create(
        string $dbName
    ): void {

        $connection = config('database.connections.sqlsrv');
        $connection['database'] = 'master';
        config(['database.connections.master' => $connection]);

        DB::connection('master')
            ->statement("CREATE DATABASE $dbName");

    }
}
