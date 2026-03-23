<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\DTO;

final class ConnectionDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $type,
        public string $description,
        public OptionsDTO $options,
        public bool $isActive,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'options' => $this->options->toArray(),
            'is_active' => $this->isActive,
        ];
    }
}
