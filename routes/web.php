<?php

declare(strict_types=1);

use App\Modules\Connection\Interfaces\Http\ConnectionCreateCommand;
use App\Modules\Connection\Interfaces\Http\ConnectionDeleteCommand;
use App\Modules\Connection\Interfaces\Http\ConnectionEditCommand;
use App\Modules\Connection\Interfaces\Http\ConnectionIndexCommand;
use App\Modules\Connection\Interfaces\Http\ConnectionStoreCommand;
use App\Modules\Connection\Interfaces\Http\ConnectionUpdateCommand;
use App\Modules\Sync\Interfaces\Http\SyncCreateController;
use App\Modules\Sync\Interfaces\Http\SyncIndexController;
use App\Modules\Sync\Interfaces\Http\SyncRunController;
use App\Modules\Sync\Interfaces\Http\SyncStoreController;
use App\Modules\Sync\Interfaces\Http\SyncViewController;
use App\Modules\User\Interfaces\Http\UserCreateCommand;
use App\Modules\User\Interfaces\Http\UserDeleteCommand;
use App\Modules\User\Interfaces\Http\UserEditCommand;
use App\Modules\User\Interfaces\Http\UserIndexCommand;
use App\Modules\User\Interfaces\Http\UserStoreCommand;
use App\Modules\User\Interfaces\Http\UserUpdateCommand;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout');
});

Route::prefix('users')
    ->as('users.')
    ->group(static function () {
        Route::get('/', UserIndexCommand::class)->name('index');
        Route::get('create', UserCreateCommand::class)->name('create');
        Route::post('store', UserStoreCommand::class)->name('store');
        Route::get('edit/{id}', UserEditCommand::class)->name('edit');
        Route::put('update/{id}', action: UserUpdateCommand::class)->name('update');
        Route::delete('delete/{id}', UserDeleteCommand::class)->name('destroy');
    });

Route::prefix('connections')
    ->as('connections.')
    ->group(static function () {
        Route::get('/', ConnectionIndexCommand::class)->name('index');
        Route::get('create', ConnectionCreateCommand::class)->name('create');
        Route::post('store', ConnectionStoreCommand::class)->name('store');
        Route::get('edit/{id}', ConnectionEditCommand::class)->name('edit');
        Route::put('update/{id}', action: ConnectionUpdateCommand::class)->name('update');
        Route::delete('delete/{id}', action: ConnectionDeleteCommand::class)->name('delete');
    });

Route::prefix('sync')
    ->as('sync.')
    ->group(static function () {
        Route::get('/', SyncIndexController::class)->name('index');
        Route::get('{uuid}/details', SyncViewController::class)->name('details');
        Route::get('/run', SyncRunController::class)->name('run');
        Route::get('create', SyncCreateController::class)->name('create');
        Route::post('store', SyncStoreController::class)->name('store');
    });
