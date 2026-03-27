<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\GrbmutMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class GrbmutAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return GrbmutMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::GRBMUT->name;
    }

    public function fields(): array
    {
        return [
            'AANT', 'AANT2', 'AANT3', 'AFGELETTERD', 'AFLCD', 'BEDR', 'BEDRVAL', 'BOEKSTUK', 'CRE',
            'DAGB', 'DAT', 'DEB', 'DEBCRE', 'DOSSIER', 'FACT', 'GRB', 'JR', 'JRAANSL', 'KDR', 'KPL',
            'PN', 'RG', 'SRT', 'TEGREK', 'TRANSROW', 'VAL',
        ];
    }

    public function filters(): array
    {
        return [
            'JR',
        ];
    }

    public function sorts(): array
    {
        return [
            'JR',
        ];
    }

    public function unique(): array
    {
        return ['JR'];
    }

    public static function schema(): array
    {
        return [
            'aant' => ['int', 'AANT'],
            'aant2' => ['int', 'AANT2'],
            'aant3' => ['int', 'AANT3'],
            'afgeletterd' => ['string', 'AFGELETTERD'],
            'aflcd' => ['string', 'AFLCD'],
            'bedr' => ['float', 'BEDR'],
            'bedrval' => ['float', 'BEDRVAL'],
            'boekstuk' => ['string', 'BOEKSTUK'],
            'cre' => ['int', 'CRE'],
            'dagb' => ['int', 'DAGB'],
            'dat' => ['string', 'DAT'],
            'deb' => ['int', 'DEB'],
            'debcre' => ['string', 'DEBCRE'],
            'dossier' => ['string', 'DOSSIER'],
            'fact' => ['int', 'FACT'],
            'grb' => ['int', 'GRB'],
            'jr' => ['int', 'JR'],
            'jraansl' => ['string', 'JRAANSL'],
            'kdr' => ['int', 'KDR'],
            'kpl' => ['int', 'KPL'],
            'pn' => ['int', 'PN'],
            'rg' => ['int', 'RG'],
            'srt' => ['string', 'SRT'],
            'tegrek' => ['int', 'TEGREK'],
            'transrow' => ['int', 'TRANSROW'],
            'val' => ['string', 'VAL'],
        ];
    }
}
