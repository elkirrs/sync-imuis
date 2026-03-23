<?php

declare(strict_types=1);

namespace App\Modules\Sync\Interfaces\Http;

use App\DataTables\SyncDataTable;

final readonly class SyncIndexController
{
    public function __invoke()
    {
        $dataTable = new SyncDataTable;

        $isAdmin = auth()->user()?->isAdmin();

        return $dataTable->render('sync.index',
            compact('isAdmin')
        );
    }
}
