<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\DTO;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class OptionsDTO extends BaseDTO
{
    public function __construct(
        public string $administrationCode,
        public string $partnerKey,
        public string $authCode,
        public string $url,
        public array $tables,
    ) {}

    public function toArray(): array
    {
        return [
            'administration_code' => $this->administrationCode,
            'partner_key' => $this->partnerKey,
            'auth_code' => $this->authCode,
            'url' => $this->url,
            'tables' => $this->tables,
        ];
    }
}
