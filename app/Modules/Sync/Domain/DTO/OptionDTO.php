<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class OptionDTO extends BaseDTO
{
    public function __construct(
        public string $dbName,
        public int $administrationId,
    ) {}
}
