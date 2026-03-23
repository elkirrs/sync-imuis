<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Contracts;

use App\Modules\Sync\Domain\DTO\QueryDTO;

interface TableAdapter
{
    public function query(): QueryDTO;

    public function map(array $row): object;

    public function unique(): string;
}
