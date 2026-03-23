<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\ValueObjects;

use InvalidArgumentException;

final class PartnerKey
{
    public function __construct(
        public string $value {
            get {
                return $this->value;
            }
        },
    ) {
        if (empty($value)) {
            throw new InvalidArgumentException('Partner Key cannot be empty');
        }
    }
}
