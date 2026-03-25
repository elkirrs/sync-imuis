<?php

namespace App\Modules\Connection\Application\Services;

use App\Helpers\Helper;
use App\Modules\Connection\Domain\Entities\ConnectionEntity;
use App\Modules\Connection\Infrastructure\Database\DatabaseCreator;
use App\Modules\Connection\Infrastructure\Database\MigrationRunner;

final readonly class CreateTenantDataBaseService
{
    public function __construct(
        private DatabaseCreator $databaseCreator,
        private MigrationRunner $migrationRunner
    ) {}

    public function createForConnection(
        ConnectionEntity $connectionEntity
    ): void {

        $dbName = Helper::TenantName($connectionEntity->id->value);

        $this->databaseCreator->create($dbName);

        $this->migrationRunner->run($dbName);
    }
}
