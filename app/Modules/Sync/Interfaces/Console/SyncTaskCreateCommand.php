<?php

declare(strict_types=1);

namespace App\Modules\Sync\Interfaces\Console;

use App\Modules\Connection\Application\Queries\ConnectionQuery;
use App\Modules\Sync\Application\Commands\SyncTaskCommand;
use App\Shared\Infrastructure\Bus\CommandBus;
use App\Shared\Infrastructure\Bus\QueryBus;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use RuntimeException;

final class SyncTaskCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:create
                            {id : Connection ID}
                            {db? : Database name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create task for sync';

    public function __construct(
        protected CommandBus $commandBus,
        protected QueryBus $queryBus
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Log::info('Create task for sync');

        $connectionId = $this->argument('id');
        $dataBaseName = $this->argument('db');

        $connectQuery = new ConnectionQuery((int) $connectionId);
        $connect = $this->queryBus->ask($connectQuery);

        if ($connect?->name === null) {
            throw new RuntimeException('Could not connect to source');
        }

        $command = new SyncTaskCommand(
            connectionId: (int) $connectionId,
            connectionName: $connect->name,
            dbName: $dataBaseName,
            availableAt: Carbon::now()->addSeconds(20)->format('Y-m-d H:i:s')
        );

        $this->commandBus->dispatch($command);
    }
}
