<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\Commands;

use App\Modules\Sync\Enums\SyncTaskStatusEnum;
use App\Shared\Domain\Bus\Command;

final readonly class SyncChangeStatusCommand implements Command
{
    public function __construct(
        public SyncTaskStatusEnum $currentStatus,
        public SyncTaskStatusEnum $chooseStatus,
    ) {}
}
