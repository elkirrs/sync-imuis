<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers\Imuis;

use App\Modules\Sync\Domain\DTO\Imuis\BtwDTO;
use App\Shared\Infrastructure\Mappers\RowMapper;

final class BtwMapper
{
    public static function fromApi(
        array $row,
        array $schema
    ): BtwDTO {

        $data = RowMapper::map(
            row: $row,
            schema: $schema,
            dtoClass: BtwDTO::class,
            excludeFields: ['connect_id', 'hash']
        );

        $data['connect_id'] = $row['connect_id'];
        $data['hash'] = null;

        return new BtwDTO(...$data);
    }
}
