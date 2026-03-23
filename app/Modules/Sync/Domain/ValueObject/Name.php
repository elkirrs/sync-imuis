<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\ValueObject;

use InvalidArgumentException;

final class Name
{
    public function __construct(
        public string $value {
            get {
                return $this->value;
            }
        }
    ) {
        if (empty($value)) {
            throw new InvalidArgumentException('Name cannot be empty');
        }
    }

    public static function generate(
        string $name,
        string $nameDB,
    ): self {

        $value = "Sync task for: $name; db: $nameDB";

        return new self($value);
    }
}
