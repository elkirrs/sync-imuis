<?php

namespace App\Modules\Connection\Interfaces\Console;

use App\Helpers\Helper;
use App\Modules\Connection\Application\Queries\ConnectionsQuery;
use App\Modules\Connection\Application\Services\CreateTenantDataBaseService;
use App\Shared\Infrastructure\Bus\QueryBus;
use Illuminate\Console\Command;

final class TenantMigrateCommand extends Command
{
    protected $signature = 'conn:tenant-migrate';

    protected $description = 'Run migration for all tenants';

    public function __construct(
        protected QueryBus $queryBus,
        private CreateTenantDataBaseService $dbService,

    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $command = new ConnectionsQuery;
        $connections = $this->queryBus->ask($command);

        foreach ($connections as $connection) {

            $tenant = Helper::TenantName($connection->id);

            $this->dbService->migrationRunner($tenant);
        }
    }
}
