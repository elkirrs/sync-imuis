<?php

declare(strict_types=1);

namespace App\Shared\Domain\DTO;

interface ArrayableDTO
{
    public function toArray(): array;
}
