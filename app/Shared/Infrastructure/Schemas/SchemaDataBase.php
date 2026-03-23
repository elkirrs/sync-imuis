<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Schemas;

interface SchemaDataBase
{
    public function table(): string;

    public function fields(): array;

    public function pageSize(): int;

    public static function schema(): array;
}
