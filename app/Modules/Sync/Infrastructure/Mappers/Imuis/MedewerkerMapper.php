<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers\Imuis;

use App\Modules\Sync\Domain\DTO\Imuis\MedewerkerDTO;
use App\Shared\Infrastructure\Mappers\RowMapper;

final class MedewerkerMapper
{
    public static function fromApi(
        array $row,
        array $schema
    ): MedewerkerDTO {

        $data = RowMapper::map(
            row: $row,
            schema: $schema,
            dtoClass: MedewerkerDTO::class,
            excludeFields: ['connect_id', 'hash']
        );

        $data['connect_id'] = $row['connect_id'];
        $data['hash'] = null;

        return new MedewerkerDTO(...$data);
    }
}
