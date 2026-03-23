<?php

declare(strict_types=1);

namespace App\Modules\Connection\Interfaces\Http;

use App\Helpers\Helper;
use App\Http\Requests\Web\Connection\StoreRequest;
use App\Modules\Connection\Application\Commands\ConnectionSaveCommand;
use App\Shared\Infrastructure\Bus\CommandBus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

final readonly class ConnectionStoreCommand
{
    public function __construct(
        protected CommandBus $commandBus,
    ) {}

    public function __invoke(
        StoreRequest $request
    ): RedirectResponse {

        $data = $request->all();

        try {

            $command = new ConnectionSaveCommand(
                id: 0,
                name: $data['name'],
                partnerKey: $data['partner_key'],
                authCode: $data['auth_code'],
                administrationCode: $data['administration_code'],
                isActive: (bool) $data['is_active'],
                description: $data['description'],
                type: 'administration',
                tables: $data['tables'] ?? [],
                url: $data['url']
            );

            $this->commandBus->dispatch($command);

            $status = 'success';
            $msg = __('Connection created successfully.');

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
