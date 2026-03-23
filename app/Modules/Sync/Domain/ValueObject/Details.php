<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\ValueObject;

final class Details
{
    public function __construct(
        public ?string $value = null {
            get {
                return $this->value;
            }
        }
    ) {
    }
}
