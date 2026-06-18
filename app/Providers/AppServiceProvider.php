<?php

declare(strict_types=1);

namespace App\Providers;

use App\Shared\Domain\Cache\CacheStorage;
use App\Shared\Infrastructure\Persistence\CacheStorage as CacheStorageImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CacheStorage::class, CacheStorageImpl::class);
        // if it will be needed to bind only for this handler,
        // but for now it is not needed, because cache is used only in this handler
        // ->when(SyncChangeStatusCommandHandler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
