<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\ValueObject;

use Illuminate\Support\Str;
use InvalidArgumentException;

final class Uuid
{
    public function __construct(
        public string $value {
            get {
                return $this->value;
            }
        },
    ) {
        if (! self::isValid($value)) {
            throw new InvalidArgumentException("Invalid UUID: {$value}");
        }
    }

    public static function generate(): self
    {
        return new self(Str::uuid7()->toString());
    }

    private static function isValid(string $uuid): bool
    {
        return Str::isUuid($uuid);
    }
}
