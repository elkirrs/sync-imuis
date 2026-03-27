<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers\Imuis;

use App\Modules\Sync\Domain\DTO\Imuis\BoeDTO;
use App\Shared\Infrastructure\Mappers\RowMapper;

final class BoeMapper
{
    public static function fromApi(
        array $row,
        array $schema
    ): BoeDTO {

        $data = RowMapper::map(
            row: $row,
            schema: $schema,
            dtoClass: BoeDTO::class,
            excludeFields: ['connect_id', 'hash']
        );

        $data['connect_id'] = $row['connect_id'];
        $data['hash'] = null;

        return new BoeDTO(...$data);
    }
}
