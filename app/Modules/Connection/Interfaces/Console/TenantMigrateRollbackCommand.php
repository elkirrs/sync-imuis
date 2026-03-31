<?php

namespace App\Modules\Connection\Interfaces\Console;

use App\Helpers\Helper;
use App\Modules\Connection\Application\Queries\ConnectionsQuery;
use App\Modules\Connection\Application\Services\CreateTenantDataBaseService;
use App\Shared\Infrastructure\Bus\QueryBus;
use Illuminate\Console\Command;

final class TenantMigrateRollbackCommand extends Command
{
    protected $signature = 'tenant:rollback {--step=0}';

    protected $description = 'Run rollback migration tenants  {--step=0}';

    public function __construct(
        protected QueryBus $queryBus,
        private CreateTenantDataBaseService $dbService,

    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $step = (int) $this->option('step');

        $command = new ConnectionsQuery;
        $connections = $this->queryBus->ask($command);

        foreach ($connections as $connection) {

            $tenant = Helper::TenantName($connection->id);

            $this->dbService->rollbackRunner($tenant, $step);
        }
    }
}
