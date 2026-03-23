<?php

declare(strict_types=1);

namespace App\Facades;

use App\Service\HtmlService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Input(int $col, string $name, ?string $label = null, ?string $value = null)
 * @method static Button(int $col, string $type, string $name, ?string $label = null, ?string $color = null, ?string $class = null)
 * @method static Link(int $col, string $name, ?string $label = null, ?array $opts = [])
 * @method static Checkbox(string $name, ?string $label = null, int|string $value = 0, bool $checked = false, bool $isSwitch = false)
 * @method static SelectMulti(int $col, string $name, string $label, array $options, array $selected = [],)
 */
class Html extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return HtmlService::class;
    }
}
