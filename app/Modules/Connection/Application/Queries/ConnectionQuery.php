<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\Queries;

use App\Shared\Domain\Bus\Query;

readonly class ConnectionQuery implements Query
{
    public function __construct(
        public int $id
    ) {}
}
