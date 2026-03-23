<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\Commands;

use App\Shared\Domain\Bus\Command;

readonly class ConnectionSaveCommand implements Command
{
    public function __construct(
        public int $id,
        public string $name,
        public string $partnerKey,
        public string $authCode,
        public string $administrationCode,
        public bool $isActive,
        public string $description,
        public string $type,
        public array $tables,
        public string $url,
    ) {}
}
