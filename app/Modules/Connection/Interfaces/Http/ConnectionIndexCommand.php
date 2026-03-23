<?php

declare(strict_types=1);

namespace App\Modules\Connection\Interfaces\Http;

use App\DataTables\ConnectionDataTable;

final readonly class ConnectionIndexCommand
{
    public function __invoke()
    {
        $dataTable = app(ConnectionDataTable::class);

        return $dataTable->render('connection.index');
    }
}
