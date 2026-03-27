<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\BeoorcodeMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class BeoorcodeAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return BeoorcodeMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::BEOORCODE->name;
    }

    public function fields(): array
    {
        return [
            'BLOK', 'BLOKPROFIEL', 'HROW', 'OMSCHR', 'PRG', 'ZKSL',
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

    public function unique(): array
    {
        return [
            'ZKSL',
        ];
    }

    public static function schema(): array
    {
        return [
            'blok' => ['bool', 'BLOK'],
            'blokprofiel' => ['bool', 'BLOKPROFIEL'],
            'hrow' => ['string', 'HROW'],
            'omschr' => ['string', 'OMSCHR'],
            'prg' => ['string', 'PRG'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
