<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters;

use App\Modules\Sync\Domain\DTO\QueryDTO;
use App\Modules\Sync\Infrastructure\Contracts\TableAdapter;
use App\Shared\Infrastructure\Schemas\SchemaDataBase;

abstract class AbstractAdapter implements SchemaDataBase, TableAdapter
{
    public function query(): QueryDTO
    {
        return new QueryDTO(
            table: $this->table(),
            fields: $this->fields(),
            filters: $this->filters(),
            sorts: $this->sorts(),
            pageSize: $this->pageSize(),
        );
    }

    abstract public function table(): string;

    abstract public function fields(): array;

    abstract public function sorts(): array;

    abstract public function map(array $row): object;

    abstract public function unique(): string;

    abstract public static function schema(): array;

    public function filters(): array
    {
        return [];
    }

    public function pageSize(): int
    {
        return 1000;
    }
}
