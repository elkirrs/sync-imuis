<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\ValueObject;

use InvalidArgumentException;

final class Attempts
{
    public function __construct(
        public int $value {
            get {
                return $this->value;
            }
        },
    ) {

        if (! isset($value)) {
            throw new InvalidArgumentException('Attempts must not be empty');
        }
    }
}
