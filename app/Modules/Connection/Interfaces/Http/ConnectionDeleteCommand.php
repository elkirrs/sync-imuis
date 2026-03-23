<?php

declare(strict_types=1);

namespace App\Modules\Connection\Interfaces\Http;

use App\Helpers\Helper;
use App\Modules\Connection\Application\Commands\ConnectionDeleteCommand as AppConnectionDeleteCommand;
use App\Shared\Domain\Bus\Command;
use App\Shared\Infrastructure\Bus\CommandBus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

final readonly class ConnectionDeleteCommand implements Command
{
    public function __construct(
        protected CommandBus $commandBus,
    ) {}

    public function __invoke(
        int $id
    ): RedirectResponse {

        try {

            $command = new AppConnectionDeleteCommand($id);

            $this->commandBus->dispatch($command);

            $status = 'success';
            $msg = __('Administration deleted successfully');
        } catch (Throwable $th) {
            $status = 'error';
            $msg = $th->getMessage();

            Log::error('ConnectionDeleteCommand', Helper::LogErrorData($th));

        }

        return redirect()->route('connections.index')
            ->with('status', $status)
            ->with('msg', $msg);
    }
}
