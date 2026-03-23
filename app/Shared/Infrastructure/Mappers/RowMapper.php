<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Mappers;

use ReflectionClass;
use ReflectionException;
use RuntimeException;

class RowMapper
{
    public static function map(
        array $row,
        array $schema,
        ?string $dtoClass = null,
        array $excludeFields = []
    ): array {
        $result = [];

        foreach ($schema as $dtoField => $rule) {

            [$type, $apiField] = $rule;

            $result[$dtoField] = match ($type) {
                'string' => FieldCaster::string($row, $apiField),
                'int' => FieldCaster::int($row, $apiField),
                'float' => FieldCaster::float($row, $apiField),
                'bool' => FieldCaster::bool($row, $apiField),
                default => null,
            };

        }

        if ($dtoClass !== null) {

            try {
                $reflection = new ReflectionClass($dtoClass);
                $dtoProps = $reflection->getProperties();
            } catch (ReflectionException $e) {
                throw new RuntimeException("DTO class $dtoClass not found or invalid: ".$e->getMessage());
            }

            $dtoKeys = array_map(fn ($p) => $p->getName(), $dtoProps);

            if (! empty($excludeFields)) {
                $dtoKeys = array_diff($dtoKeys, $excludeFields);
            }

            $missing = array_diff($dtoKeys, array_keys($result));

            if (! empty($missing)) {
                throw new RuntimeException('Missing DTO fields: '.implode(', ', $missing));
            }
        }

        return $result;
    }
}
