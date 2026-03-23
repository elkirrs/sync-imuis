<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\Commands;

use App\Shared\Domain\Bus\Command;

readonly class ConnectionDeleteCommand implements Command
{
    public function __construct(
        public int $id,
    ) {}
}
