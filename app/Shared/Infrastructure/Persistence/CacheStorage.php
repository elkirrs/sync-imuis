<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence;

use App\Shared\Domain\Cache\CacheStorage as ICacheStorage;
use Illuminate\Support\Facades\Cache;

final class CacheStorage implements ICacheStorage
{
    public function acquire(
        string $key,
        mixed $value,
        int $ttl = 3600,
    ): bool {

        return Cache::add($key, $value, $ttl);
    }

    public function release(string $key): void
    {
        Cache::forget($key);
    }

    public function getValue(
        string $key,
        mixed $default = null
    ): ?string {

        return Cache::get($key, $default);
    }
}
