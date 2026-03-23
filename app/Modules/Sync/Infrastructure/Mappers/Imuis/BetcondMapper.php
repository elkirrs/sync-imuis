<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers\Imuis;

use App\Modules\Sync\Domain\DTO\Imuis\BetcondDTO;
use App\Shared\Infrastructure\Mappers\RowMapper;

final class BetcondMapper
{
    public static function fromApi(
        array $row,
        array $schema
    ): BetcondDTO {

        $data = RowMapper::map($row, $schema, BetcondDTO::class, ['connect_id', 'hash']);
        $data['connect_id'] = $row['connect_id'];
        $data['hash'] = null;

        return new BetcondDTO(...$data);
    }
}
