<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\Repositories;

use App\Modules\Connection\Domain\Entities\ConnectionEntity;

interface ConnectionRepository
{
    public function save(ConnectionEntity $entity): void;

    public function findOne(int $int): ConnectionEntity;

    public function delete(ConnectionEntity $entity): void;
}
