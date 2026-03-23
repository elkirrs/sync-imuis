<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\ValueObject;

use InvalidArgumentException;

final class Message
{
    public function __construct(
        public string $value {
            get {
                return $this->value;
            }
        }
    ) {
        if (empty($value)) {
            throw new InvalidArgumentException('Message cannot be empty');
        }
    }
}
