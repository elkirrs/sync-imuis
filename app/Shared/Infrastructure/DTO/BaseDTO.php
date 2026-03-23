<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\DTO;

use App\Shared\Domain\DTO\ArrayableDTO;
use JsonSerializable;

abstract readonly class BaseDTO implements ArrayableDTO, JsonSerializable
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
