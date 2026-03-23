<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class QueryDTO extends BaseDTO
{
    public function __construct(
        public string $table,
        public array $fields = [],
        public array $filters = [],
        public array $sorts = [],
        public int $pageSize = 100,
    ) {}
}
