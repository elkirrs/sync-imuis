<?php

declare(strict_types=1);

namespace App\Helpers;

use Throwable;

final readonly class Helper
{
    public static function LogErrorData(
        Throwable $th
    ): array {
        return [
            'msg' => $th->getMessage(),
            'code' => $th->getCode(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
        ];
    }

    public static function BulkWithLimit(
        int $columnsCount,
        int $limit = 0,
        int $chunk = 500
    ): int {

        if ($limit === 0) {
            return $chunk;
        }

        $maxRowsPerBatch = (int) floor($limit / $columnsCount) - 1;

        return min($chunk, $maxRowsPerBatch);
    }
}
