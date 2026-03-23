<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Mappers;

final class FieldCaster
{
    public static function string(array $row, string $key): ?string
    {
        if (! array_key_exists($key, $row)) {
            return null;
        }

        if (is_array($row[$key]) && count($row[$key]) === 0) {
            return null;
        }

        $value = trim((string) $row[$key]);

        return $value === '' ? null : $value;
    }

    public static function int(array $row, string $key): ?int
    {
        if (! array_key_exists($key, $row) || $row[$key] === '' || $row[$key] === null) {
            return null;
        }

        if (is_array($row[$key]) && count($row[$key]) === 0) {
            return 0;
        }

        return (int) $row[$key];
    }

    public static function float(array $row, string $key): ?float
    {
        if (! array_key_exists($key, $row) || $row[$key] === '' || $row[$key] === null) {
            return null;
        }

        if (is_array($row[$key]) && count($row[$key]) === 0) {
            return 0.0;
        }

        return (float) $row[$key];
    }

    public static function bool(array $row, string $key): ?bool
    {
        if (! array_key_exists($key, $row) || $row[$key] === '' || $row[$key] === null) {
            return null;
        }

        if (is_array($row[$key]) && count($row[$key]) === 0) {
            return false;
        }

        return (bool) $row[$key];
    }
}
