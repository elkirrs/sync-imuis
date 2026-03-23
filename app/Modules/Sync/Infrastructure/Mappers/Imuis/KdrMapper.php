<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers\Imuis;

use App\Modules\Sync\Domain\DTO\Imuis\KdrDTO;
use App\Shared\Infrastructure\Mappers\RowMapper;

final class KdrMapper
{
    public static function fromApi(
        array $row,
        array $schema
    ): KdrDTO {

        $data = RowMapper::map(
            row: $row,
            schema: $schema,
            dtoClass: KdrDTO::class,
            excludeFields: ['connect_id', 'hash']
        );
        $data['connect_id'] = $row['connect_id'];
        $data['hash'] = null;

        return new KdrDTO(...$data);
    }
}
