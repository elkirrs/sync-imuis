<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\KoersMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class KoersAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return KoersMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::KOERS->name;
    }

    public function fields(): array
    {
        return ['BLOKPROFIEL', 'DATVAN', 'KOERS', 'KOERSDEFVAL', 'NR', 'VAL'];
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

    public function unique(): array
    {
        return ['NR'];
    }

    public static function schema(): array
    {
        return [
            'blokprofiel' => ['bool', 'BLOKPROFIEL'],
            'datvan' => ['string', 'DATVAN'],
            'koers' => ['float', 'KOERS'],
            'koersdefval' => ['float', 'KOERSDEFVAL'],
            'nr' => ['int', 'NR'],
            'val' => ['string', 'VAL'],
        ];
    }
}
