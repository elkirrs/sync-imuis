<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\ValueObject;

use Carbon\Carbon;

final class DateTime
{
    public function __construct(
        public ?string $value = null {
            get {
                return $this->value;
            }
        },
    ) {
    }

    public static function generate(
        string $dateTime,
        int $addSeconds = 0,
    ): self {
        $value = Carbon::parse($dateTime)
            ->addSeconds($addSeconds)
            ->format('Y-m-d H:i:s');

        return new self($value);
    }
}
