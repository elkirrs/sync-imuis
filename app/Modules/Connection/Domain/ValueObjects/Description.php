<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\ValueObjects;

final class Description
{
    public function __construct(
        public string $value {
            get {
                return $this->value;
            }
        },
    ) {
    }
}
