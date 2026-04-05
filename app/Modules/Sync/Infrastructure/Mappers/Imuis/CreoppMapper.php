<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers\Imuis;

use App\Modules\Sync\Domain\DTO\Imuis\CreoppDTO;
use App\Shared\Infrastructure\Mappers\RowMapper;

final class CreoppMapper
{
    public static function fromApi(
        array $row,
        array $schema
    ): CreoppDTO {

        $data = RowMapper::map(
            row: $row,
            schema: $schema,
            dtoClass: CreoppDTO::class,
            excludeFields: ['connect_id', 'hash']
        );
        $data['connect_id'] = $row['connect_id'];
        $data['hash'] = null;

        return new CreoppDTO(...$data);
    }
}
