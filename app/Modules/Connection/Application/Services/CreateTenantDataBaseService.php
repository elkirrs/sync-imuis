<?php

namespace App\Modules\Connection\Application\Services;

use App\Helpers\Helper;
use App\Modules\Connection\Domain\Entities\ConnectionEntity;
use App\Modules\Connection\Infrastructure\Database\DatabaseCreator;
use App\Modules\Connection\Infrastructure\Database\MigrationRunner;
use App\Modules\Connection\Infrastructure\Database\RollbackRunner;

final readonly class CreateTenantDataBaseService
{
    public function __construct(
        private DatabaseCreator $databaseCreator,
        private MigrationRunner $migrationRunner,
        private RollbackRunner $rollbackRunner,
    ) {}

    public function createForConnection(
        ConnectionEntity $connectionEntity
    ): void {

        $dbName = Helper::TenantName($connectionEntity->id->value);

        $this->databaseCreator($dbName);

        $this->migrationRunner($dbName);
    }

    public function databaseCreator(
        string $dbName
    ): void {

        $this->databaseCreator->create($dbName);

    }

    public function migrationRunner(
        string $dbName
    ): void {

        $this->migrationRunner->run($dbName);

    }

    public function rollbackRunner(
        string $dbName,
        int $steps = 0,
    ): void {

        $this->rollbackRunner->run($dbName, $steps);

    }
}
