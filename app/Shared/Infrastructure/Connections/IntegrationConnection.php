<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Connections;

readonly class IntegrationConnection
{
    public function __construct(
        public string $clientName, // imuis, db2, etc
        public array $credentials, // parentKey, code, etc
    ) {}
}
