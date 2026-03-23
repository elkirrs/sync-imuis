<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\Commands;

use App\Modules\Sync\Domain\DTO\ReasonDTO;
use App\Shared\Domain\Bus\Command;

final readonly class SyncTaskStatusCommand implements Command
{
    public function __construct(
        public string $uuid,
        public int $status,
        public ?ReasonDTO $reason = null,
    ) {}
}
