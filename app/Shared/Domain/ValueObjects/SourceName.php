<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use InvalidArgumentException;

final class SourceName
{
    public function __construct(
        private string $value
    ) {
        if (empty($value)) {
            throw new InvalidArgumentException('SourceName connot be empty');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
