<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\ValueObjects;

use InvalidArgumentException;

final class Tables
{
    public function __construct(
        public array $value {
            get {
                return $this->value;
            }
        },
    ) {
        if (empty($value)) {
            throw new InvalidArgumentException('Tables cannot be empty');
        }
    }
}
