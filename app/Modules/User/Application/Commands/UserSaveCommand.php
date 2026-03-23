<?php

declare(strict_types=1);

namespace App\Modules\User\Application\Commands;

use App\Shared\Domain\Bus\Command;

readonly class UserSaveCommand implements Command
{
    public function __construct(
        public int $id,
        public string $username,
        public string $email,
        public string $password,
        public bool $isActive,
    ) {}
}
