<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\ValueObjects;

use InvalidArgumentException;

final class Active
{
    public function __construct(
        public bool $value {
            get {
                return $this->value;
            }
        },
    ) {

        if (! isset($value)) {
            throw new InvalidArgumentException('Active cannot be empty');
        }
    }
}
