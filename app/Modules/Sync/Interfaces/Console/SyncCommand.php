<?php

declare(strict_types=1);

namespace App\Modules\Sync\Interfaces\Console;

use App\Modules\Sync\Application\Commands\SyncTaskAllCommand as SyncTaskCommand;
use App\Modules\Sync\Application\Commands\SyncTaskScheduleCommand;
use App\Shared\Infrastructure\Bus\CommandBus;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class SyncCommand extends Command
{
    protected $signature = 'sync:all';

    protected $description = 'Run sync for all connections';

    public function __construct(
        protected CommandBus $commandBus
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        Log::info('Generate tasks for sync');

        $command = new SyncTaskCommand(
            Carbon::now()->addSeconds(10)->format('Y-m-d H:i:s'),
        );
        $this->commandBus->dispatch($command);

        Log::info('Run sync tasks by scheduled');
        $command = new SyncTaskScheduleCommand;
        $this->commandBus->dispatch($command);
    }
}
