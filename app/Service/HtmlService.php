<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\View as ViewAlias;

final class HtmlService
{
    public static function Input(
        int $col = 12,
        string $type = 'text',
        string $name = '',
        string $label = '',
        ?string $value = null,
    ): Factory|View|ViewAlias {
        return view('components.text', compact(
            'col',
            'name',
            'label',
            'value',
            'type'
        ));
    }

    public static function Button(
        int $col,
        string $type,
        string $name,
        string $label,
        array $opts = []
    ): Factory|View|ViewAlias {

        $options = '';
        $isClass = false;
        foreach ($opts as $key => $value) {
            $options .= ' '.$key.'="'.$value.'"';
            if (strtolower($key) === 'class') {
                $isClass = true;
            }
        }

        if (! $isClass) {
            $options .= ' class="btn btn-outline-success';
        }

        return view('components.button', compact(
            'col',
            'name',
            'label',
            'type',
            'options'
        ));
    }

    public static function Link(
        string $url,
        string $label,
        array $opts = []
    ): Factory|View|ViewAlias {

        $options = '';

        foreach ($opts as $key => $value) {
            $options .= ' '.$key.'="'.$value.'"';
        }

        return view('components.link', compact(
            'url',
            'label',
            'options'
        ));
    }

    public static function Checkbox(
        string $name,
        ?string $label = null,
        int|string $value = 0,
        bool $checked = false,
        bool $isSwitch = false,
    ): Factory|View|ViewAlias {
        return view('components.checkbox', compact(
            'name',
            'label',
            'value',
            'checked',
            'isSwitch',
        ));
    }

    public static function SelectMulti(
        int $col,
        string $name,
        string $label,
        array $options,
        array $selected = []
    ): Factory|View|ViewAlias {
        return view('components.select', compact(
            'col',
            'name',
            'label',
            'options',
            'selected'
        ));
    }
}
