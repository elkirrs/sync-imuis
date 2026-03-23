<?php

declare(strict_types=1);

namespace App\Providers;

use App\Modules\Sync\Infrastructure\ExternalClients\ImuisClient;
use App\Shared\Infrastructure\Factories\ClientFactory;
use Illuminate\Support\ServiceProvider;

class ExternalClientServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->tag([
            ImuisClient::class,
            // Another external clients
        ], 'external.clients');

        $this->app->bind(ClientFactory::class, function ($app) {
            return new ClientFactory(
                $app->tagged('external.clients')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
