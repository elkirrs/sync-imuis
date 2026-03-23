<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\Commands;

use App\Shared\Domain\Bus\Command;

final readonly class SyncTaskAllCommand implements Command
{
    public function __construct(
        public string $dateTimeStart
    ) {}
}
