<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers\Imuis;

use App\Modules\Sync\Domain\DTO\Imuis\ArtDTO;
use App\Shared\Infrastructure\Mappers\RowMapper;

final class ArtMapper
{
    public static function fromApi(
        array $row,
        array $schema
    ): ArtDTO {

        $data = RowMapper::map(
            $row,
            schema: $schema,
            dtoClass: ArtDTO::class,
            excludeFields: ['connect_id', 'hash']
        );

        $data['connect_id'] = $row['connect_id'];
        $data['hash'] = null;

        return new ArtDTO(...$data);
    }
}
