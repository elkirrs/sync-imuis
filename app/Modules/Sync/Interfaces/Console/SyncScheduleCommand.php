<?php

declare(strict_types=1);

namespace App\Modules\Sync\Interfaces\Console;

use App\Modules\Sync\Application\Commands\SyncTaskScheduleCommand;
use App\Shared\Infrastructure\Bus\CommandBus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class SyncScheduleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run sync tasks by scheduled';

    public function __construct(
        protected CommandBus $commandBus
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Log::info('Run sync tasks by scheduled');
        $command = new SyncTaskScheduleCommand;
        $this->commandBus->dispatch($command);

    }
}
