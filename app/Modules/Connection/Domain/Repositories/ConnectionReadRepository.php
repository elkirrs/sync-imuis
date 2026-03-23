<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\Repositories;

use App\Modules\Connection\Domain\Entities\ConnectionEntity;

interface ConnectionReadRepository
{
    public function findAllActive(): array;

    public function findOne(int $int): ConnectionEntity;
}
