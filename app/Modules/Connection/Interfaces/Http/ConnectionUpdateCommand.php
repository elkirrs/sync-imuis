<?php

declare(strict_types=1);

namespace App\Modules\Connection\Interfaces\Http;

use App\Helpers\Helper;
use App\Http\Requests\Web\Connection\UpdateRequest;
use App\Modules\Connection\Application\Commands\ConnectionSaveCommand;
use App\Shared\Infrastructure\Bus\CommandBus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

final readonly class ConnectionUpdateCommand
{
    public function __construct(
        protected CommandBus $commandBus,
    ) {}

    public function __invoke(
        UpdateRequest $request,
        int $id
    ): RedirectResponse {

        $data = $request->all();

        try {

            $command = new ConnectionSaveCommand(
                id: $id,
                name: $data['name'],
                partnerKey: $data['partner_key'],
                authCode: $data['auth_code'],
                administrationCode: $data['administration_code'],
                isActive: (bool) $data['is_active'],
                description: $data['description'],
                type: 'administration',
                tables: $data['tables'] ?? [],
                url: $data['url'],
            );

            $this->commandBus->dispatch($command);

            $status = 'success';
            $msg = __('Connection updated successfully.');

        } catch (Throwable $th) {
            $status = 'error';
            $msg = $th->getMessage();

            Log::error('ConnectionUpdateCommand', Helper::LogErrorData($th));
        }

        return redirect()->route('connections.index')
            ->with('status', $status)
            ->with('msg', $msg);
    }
}
