<?php

declare(strict_types=1);

namespace App\Providers;

use App\Modules\Connection\Domain\Repositories\ConnectionReadRepository;
use App\Modules\Connection\Domain\Repositories\ConnectionRepository;
use App\Modules\Connection\Infrastructure\Persistence\EloquentConnectionRepository;
use App\Modules\Sync\Domain\Repositories\SyncRepository;
use App\Modules\Sync\Domain\Repositories\SyncTaskDetailRepository;
use App\Modules\Sync\Domain\Repositories\SyncTaskRepository;
use App\Modules\Sync\Infrastructure\Persistence\EloquentSyncRepository;
use App\Modules\Sync\Infrastructure\Persistence\EloquentSyncTaskDetailRepository;
use App\Modules\Sync\Infrastructure\Persistence\EloquentSyncTaskRepository;
use App\Modules\User\Domain\Repositories\UserRepository;
use App\Modules\User\Infrustructure\Persistence\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class SyncServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ConnectionRepository::class, EloquentConnectionRepository::class);
        $this->app->bind(ConnectionReadRepository::class, EloquentConnectionRepository::class);
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(SyncTaskRepository::class, EloquentSyncTaskRepository::class);
        $this->app->bind(SyncRepository::class, EloquentSyncRepository::class);
        $this->app->bind(SyncTaskDetailRepository::class, EloquentSyncTaskDetailRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
