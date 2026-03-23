<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class ReasonDTO extends BaseDTO
{
    public function __construct(
        public string $msg,
        public int $status,
        public ?string $details = null,
    ) {}
}
