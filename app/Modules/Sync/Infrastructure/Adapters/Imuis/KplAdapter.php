<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\KplMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class KplAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return KplMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::KPL->name;
    }

    public function fields(): array
    {
        return [
            'BLOK', 'BUDH', 'KPLUBLINL', 'NIVO', 'NR', 'OMSCHR', 'SELCD', 'ZKSL',
        ];
    }

    public function filters(): array
    {
        return [
            'NR',
        ];
    }

    public function sorts(): array
    {
        return [
            'NR',
        ];
    }

    public function unique(): string
    {
        return 'NR';
    }

    public static function schema(): array
    {
        return [
            'blok' => ['bool', 'BLOK'],
            'budh' => ['string', 'BUDH'],
            'kplublinl' => ['string', 'KPLUBLINL'],
            'nivo' => ['int', 'NIVO'],
            'nr' => ['int', 'NR'],
            'omschr' => ['string', 'OMSCHR'],
            'selcd' => ['string', 'SELCD'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
