<?php

declare(strict_types=1);

namespace App\Shared\Domain\Contracts;

use App\Modules\Sync\Domain\DTO\QueryDTO;

interface ExternalClient
{
    public function connect(array $credentials): void;

    public function fetch(QueryDTO $query): iterable;

    public function supports(string $externalName): bool;

    public function clientName(): string;
}
