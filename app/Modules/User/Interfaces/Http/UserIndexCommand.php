<?php

declare(strict_types=1);

namespace App\Modules\User\Interfaces\Http;

use App\DataTables\UsersDataTable;

final readonly class UserIndexCommand
{
    public function __invoke()
    {
        $isAdmin = auth()?->user()?->isAdmin();

        $dataTable = app(UsersDataTable::class);
        $dataTable->isAdmin = $isAdmin;

        return $dataTable->render('user.index', compact('isAdmin'));
    }
}
