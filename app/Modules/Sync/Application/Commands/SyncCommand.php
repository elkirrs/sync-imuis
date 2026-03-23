<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\Commands;

use App\Shared\Domain\Bus\Command;

final readonly class SyncCommand implements Command
{
    public function __construct(
        public int $administrationId,
        public string $table,
        public string $client,
        public string $uuid,
    ) {}
}
