<?php

declare(strict_types=1);

namespace App\Providers;

use App\Service\HtmlService;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HtmlService::class, function ($app) {
            return new HtmlService;
        });
    }

    public function boot(): void
    {
        //
    }
}
