<?php

declare(strict_types=1);

namespace App\Modules\Connection\Interfaces\Http;

use App\Helpers\Helper;
use App\Modules\Connection\Application\Commands\ConnectionCreateTenantCommand as ConnectionCreateTenant;
use App\Shared\Infrastructure\Bus\CommandBus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

final readonly class ConnectionCreateTenantCommand
{
    public function __construct(
        protected CommandBus $commandBus,
    ) {}

    public function __invoke(int $id): RedirectResponse
    {
        try {

            $command = new ConnectionCreateTenant(
                id: $id
            );

            $this->commandBus->dispatch($command);

            $status = 'success';
            $msg = __('Connection Tenant DB created successfully.');

        } catch (Throwable $th) {
            $status = 'error';
            $msg = $th->getMessage();

            Log::error('ConnectionStoreCommand', Helper::LogErrorData($th));
        }

        return redirect()->route('connections.index')
            ->with('status', $status)
            ->with('msg', $msg);
    }
}
