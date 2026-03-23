<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class SyncTaskDTO extends BaseDTO
{
    public function __construct(
        public string $uuid,
        public string $name,
        public int $status,
        public OptionDTO $options,
        public int $attempts,
        public string $availableAt,
        public string $createdAt,
        public ?string $finishedAt,
    ) {}

    public function toArray(): array
    {
        $result = parent::toArray();
        $result['options'] = $this->options->toArray();

        return $result;
    }
}
