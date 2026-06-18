<?php

declare(strict_types=1);

namespace App\Shared\Domain\Cache;

interface CacheStorage
{
    public function acquire(string $key, mixed $value, int $ttl = 3600): bool;

    public function release(string $key): void;

    public function getValue(string $key, mixed $default = null): ?string;
}
