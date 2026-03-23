<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\Queries;

use App\Shared\Domain\Bus\Query;

final class SyncTaskQuery implements Query
{
    public function __construct(
        public string $uuid,
    ) {}
}
