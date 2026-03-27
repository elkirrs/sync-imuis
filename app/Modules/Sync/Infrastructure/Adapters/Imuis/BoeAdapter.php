<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\BoeMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class BoeAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return BoeMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::BOE->name;
    }

    public function fields(): array
    {
        return [
            'AANT', 'AANT2', 'AANT3', 'AANTCRE', 'AANTCRE2', 'AANTCRE3', 'AANTDEB', 'AANTDEB2', 'AANTDEB3', 'BEDR',
            'BEDRBETKORT', 'BEDRBOEK', 'BEDRBOEKVAL', 'BEDRBTW', 'BEDRCRE', 'BEDRDEB', 'BEDRINCL', 'BEDRKB',
            'BEDRBTWVAL', 'BEOORCD', 'BOEKSTUK', 'BTW', 'CRE', 'DAGB', 'DAT', 'DEB', 'DOSSIER', 'FACT',
            'GRB', 'GRPROW', 'ISOPBOEK', 'JR', 'KDR', 'KOERS', 'KPL', 'OMSCHR', 'OPM', 'PN', 'PRG', 'REK',
            'RG', 'STORNO', 'TEGREK', 'VAL',
        ];
    }

    public function filters(): array
    {
        return [
            ['JR', '=', '2024'],
            ['PN', '=', '1'],
        ];
    }

    public function sorts(): array
    {
        return [
            'JR', 'PN',
        ];
    }

    public function unique(): array
    {
        return [
            'JR', 'PN',
        ];
    }

    public static function schema(): array
    {
        return [
            'aant' => ['float', 'AANT'],
            'aant2' => ['float', 'AANT2'],
            'aant3' => ['float', 'AANT3'],
            'aantcre' => ['float', 'AANTCRE'],
            'aantcre2' => ['float', 'AANTCRE2'],
            'aantcre3' => ['float', 'AANTCRE3'],
            'aantdeb' => ['float', 'AANTDEB'],
            'aantdeb2' => ['float', 'AANTDEB2'],
            'aantdeb3' => ['float', 'AANTDEB3'],
            'bedr' => ['float', 'BEDR'],
            'bedrbetkort' => ['float', 'BEDRBETKORT'],
            'bedrboek' => ['float', 'BEDRBOEK'],
            'bedrboekval' => ['float', 'BEDRBOEKVAL'],
            'bedrbtw' => ['float', 'BEDRBTW'],
            'bedrcre' => ['float', 'BEDRCRE'],
            'bedrdeb' => ['float', 'BEDRDEB'],
            'bedrincl' => ['float', 'BEDRINCL'],
            'bedrkb' => ['float', 'BEDRKB'],
            'bedrbtwval' => ['float', 'BEDRBTWVAL'],
            'beoorcd' => ['string', 'BEOORCD'],
            'boekstuk' => ['string', 'BOEKSTUK'],
            'btw' => ['int', 'BTW'],
            'cre' => ['int', 'CRE'],
            'dagb' => ['int', 'DAGB'],
            'dat' => ['string', 'DAT'],
            'deb' => ['int', 'DEB'],
            'dossier' => ['string', 'DOSSIER'],
            'fact' => ['string', 'FACT'],
            'grb' => ['int', 'GRB'],
            'grprow' => ['int', 'GRPROW'],
            'isopboek' => ['bool', 'ISOPBOEK'],
            'jr' => ['int', 'JR'],
            'kdr' => ['int', 'KDR'],
            'koers' => ['float', 'KOERS'],
            'kpl' => ['int', 'KPL'],
            'omschr' => ['string', 'OMSCHR'],
            'opm' => ['string', 'OPM'],
            'pn' => ['int', 'PN'],
            'prg' => ['string', 'PRG'],
            'rek' => ['int', 'REK'],
            'rg' => ['int', 'RG'],
            'storno' => ['bool', 'STORNO'],
            'tegrek' => ['int', 'TEGREK'],
            'val' => ['string', 'VAL'],
        ];
    }
}
