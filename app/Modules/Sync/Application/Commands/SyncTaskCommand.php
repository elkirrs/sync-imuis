<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\Commands;

use App\Shared\Domain\Bus\Command;

final readonly class SyncTaskCommand implements Command
{
    public function __construct(
        public int $connectionId,
        public string $connectionName,
        public string $dbName,
        public string $availableAt
    ) {}
}
