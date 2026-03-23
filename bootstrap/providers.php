<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\ExternalClientServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\HtmlServiceProvider;
use App\Providers\SyncServiceProvider;

return [
    AppServiceProvider::class,
    ExternalClientServiceProvider::class,
    FortifyServiceProvider::class,
    HtmlServiceProvider::class,
    SyncServiceProvider::class,
];
