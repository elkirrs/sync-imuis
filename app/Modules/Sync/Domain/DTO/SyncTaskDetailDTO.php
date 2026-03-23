<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class SyncTaskDetailDTO extends BaseDTO
{
    public function __construct(
        public string $uuid,
        public string $syncUuid,
        public int $userId,
        public int $userType,
        public string $message,
        public int $status,
        public ?string $details,
        public string $createdAt,
    ) {}
}
