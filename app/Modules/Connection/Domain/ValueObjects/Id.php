<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\ValueObjects;

use InvalidArgumentException;

final class Id
{
    public function __construct(
        public int $value {
            get {
                return $this->value;
            }
        },
    ) {
        if (! isset($value)) {
            throw new InvalidArgumentException('Connection id cannot be empty');
        }
    }
}
