<?php

declare(strict_types=1);

namespace App\Modules\User\Domain\DTO;

class UserDTO
{
    public function __construct(
        public int $id,
        public string $username,
        public string $email,
        public ?string $password,
        public bool $isActive,
    ) {}
}
