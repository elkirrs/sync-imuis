<?php

declare(strict_types=1);

namespace App\Modules\Sync\Interfaces\Http;

use App\Helpers\Helper;
use App\Modules\Sync\Application\Commands\SyncTaskAllCommand as SyncTaskCommand;
use App\Modules\Sync\Application\Commands\SyncTaskScheduleCommand;
use App\Shared\Infrastructure\Bus\CommandBus;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

final readonly class SyncRunController
{
    public function __construct(
        protected CommandBus $commandBus
    ) {}

    public function __invoke(): RedirectResponse
    {
        try {
            $command = new SyncTaskCommand(
                Carbon::now()->addSeconds(10)->format('Y-m-d H:i:s'),
            );
            $this->commandBus->dispatch($command);

            $command = new SyncTaskScheduleCommand;
            $this->commandBus->dispatch($command);

            $msg = __('Sync task was runed successfully.');
            $status = 'success';

        } catch (Throwable $th) {
            Log::error('SyncRunController', Helper::LogErrorData($th));

            $msg = 'Sync task was not run successfully.';
            $status = 'error';
        }

        return back()
            ->with('status', $status)
            ->with('msg', $msg);
    }
}
