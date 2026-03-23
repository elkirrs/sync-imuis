<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\ValMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class ValAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return ValMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::VAL->name;
    }

    public function fields(): array
    {
        return [
            'AANTKOERS', 'AFR', 'BLOK', 'BLOKPROFIEL', 'HERWKST', 'HERWOPBR', 'ISO',
            'JRVERV', 'KOERS', 'KOERSDEFVAL', 'KRSVERSKST', 'KRSVERSOPBR', 'OMSCHR', 'TEKEN', 'ZKSL',
        ];
    }

    public function filters(): array
    {
        return [
            'ZKSL',
        ];
    }

    public function sorts(): array
    {
        return [
            'ZKSL',
        ];
    }

    public function unique(): string
    {
        return 'ZKSL';
    }

    public static function schema(): array
    {
        return [
            'zksl' => ['string', 'ZKSL'],
            'aantkoers' => ['float', 'AANTKOERS'],
            'afr' => ['int', 'AFR'],
            'blok' => ['bool', 'BLOK'],
            'blokprofiel' => ['bool', 'BLOKPROFIEL'],
            'herwkst' => ['int', 'HERWKST'],
            'herwopbr' => ['int', 'HERWOPBR'],
            'iso' => ['string', 'ISO'],
            'jrverv' => ['int', 'JRVERV'],
            'koers' => ['float', 'KOERS'],
            'koersdefval' => ['float', 'KOERSDEFVAL'],
            'krsverskst' => ['int', 'KRSVERSKST'],
            'krsversopbr' => ['int', 'KRSVERSOPBR'],
            'omschr' => ['string', 'OMSCHR'],
            'teken' => ['string', 'TEKEN'],
        ];
    }
}
