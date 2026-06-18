<?php

declare(strict_types=1);

namespace App\Modules\Sync\Interfaces\Console;

use App\Modules\Sync\Application\Commands\SyncChangeStatusCommand as SyncChangeStatusCmd;
use App\Modules\Sync\Enums\SyncTaskStatusEnum;
use App\Shared\Infrastructure\Bus\CommandBus;
use Illuminate\Console\Command;

final class SyncChangeStatusCommand extends Command
{
    protected $signature = 'sync:change-status
                            {--from=}
                            {--to=}';

    protected $description = 'Change status';

    public function __construct(
        protected CommandBus $commandBus
    ) {
        parent::__construct();
    }

    public function handle(): void
    {

        $this->info('Sync change status is running...');

        $currentStatus = $this->option('from');
        $chooseStatus = $this->option('to');

        $command = new SyncChangeStatusCmd(
            currentStatus: SyncTaskStatusEnum::fromString($currentStatus),
            chooseStatus: SyncTaskStatusEnum::fromString($chooseStatus)
        );

        $this->commandBus->dispatch($command);

        $this->info('Sync change status finished');
    }
}
