<?php

declare(strict_types=1);

namespace App\Modules\Connection\Enums;

enum IsActiveConnection: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;

    public function toString(): string
    {
        return match ($this) {
            self::ACTIVE => __('Active'),
            self::INACTIVE => __('Inactive'),
        };
    }
}
