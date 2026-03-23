<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence;

interface BaseRepository
{
    public function save(object $entity): void;
}
