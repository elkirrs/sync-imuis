<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers\Imuis;

use App\Modules\Sync\Domain\DTO\Imuis\SelcodeDTO;
use App\Shared\Infrastructure\Mappers\RowMapper;

final class SelcodeMapper
{
    public static function fromApi(
        array $row,
        array $schema
    ): SelcodeDTO {

        $data = RowMapper::map(
            row: $row,
            schema: $schema,
            dtoClass: SelcodeDTO::class,
            excludeFields: ['connect_id', 'hash']
        );

        $data['connect_id'] = $row['connect_id'];
        $data['hash'] = null;

        return new SelcodeDTO(...$data);
    }
}
