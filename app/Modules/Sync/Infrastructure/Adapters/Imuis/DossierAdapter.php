<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\DossierMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class DossierAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return DossierMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::DOSSIER->name;
    }

    public function fields(): array
    {
        return [
            'BLOK', 'BLOKHANDM', 'BLOKPROFIEL', 'DATBEGIN', 'DATEIND', 'KDR', 'KPL', 'LOCATIE',
            'OMSCHR', 'OPM', 'WKROPTIE', 'ZKSL',
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
        return ['ZKSL'];
    }

    public static function schema(): array
    {
        return [
            'blok' => ['bool', 'BLOK'],
            'blokhandm' => ['bool', 'BLOKHANDM'],
            'blokprofiel' => ['bool', 'BLOKPROFIEL'],
            'datbegin' => ['string', 'DATBEGIN'],
            'dateind' => ['string', 'DATEIND'],
            'kdr' => ['int', 'KDR'],
            'kpl' => ['int', 'KPL'],
            'locatie' => ['string', 'LOCATIE'],
            'omschr' => ['string', 'OMSCHR'],
            'opm' => ['string', 'OPM'],
            'wkroptie' => ['string', 'WKROPTIE'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
