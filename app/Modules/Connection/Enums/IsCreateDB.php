<?php

declare(strict_types=1);

namespace App\Modules\Connection\Enums;

enum IsCreateDB: int
{
    case CREATED = 1;
    case NOT_CREATED = 0;

    public function toString(): string
    {
        return match ($this) {
            self::CREATED => __('Created'),
            self::NOT_CREATED => __('Not Created'),
        };
    }
}
