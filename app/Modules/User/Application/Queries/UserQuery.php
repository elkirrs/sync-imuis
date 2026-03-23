<?php

declare(strict_types=1);

namespace App\Modules\User\Application\Queries;

use App\Shared\Domain\Bus\Query;

readonly class UserQuery implements Query
{
    public function __construct(
        public int $id
    ) {}
}
