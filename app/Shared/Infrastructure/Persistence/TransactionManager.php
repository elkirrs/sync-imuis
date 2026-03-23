<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;

class TransactionManager
{
    public function run(
        callable $callback,
        int $attempts = 3
    ): mixed {

        return DB::transaction(
            $callback,
            $attempts
        );
    }
}
