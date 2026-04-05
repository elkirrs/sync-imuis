<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\CreoppMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class CreoppAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return CreoppMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::CREOPP->name;
    }

    public function fields(): array
    {
        return [
            'AFLGEBR', 'BEDR', 'BEDRBKRTTEBETVAL', 'BEDRBTW', 'BEDRBTWVAL', 'BEDRGREK', 'BEDRKB', 'BEDRKBVAL',
            'BEDROORSPRVAL', 'BEDRTEBET', 'BEDRVAL', 'BET', 'BETGREK', 'BETVAL', 'BETWIST', 'CRE', 'CREDITNOTACRE',
            'CREDITNOTAFACT', 'DAT', 'DATLSTBET', 'DATVERV', 'FACT', 'FIAT', 'FIATINKOOP', 'INCASSO', 'KDR',
            'KENM', 'KENMBATCH', 'KPL', 'OMSCHR', 'OPM', 'SALDO', 'SALDOGREK', 'SALDOOORSPRVAL', 'SALDOVAL',
            'VOLDAAN',
        ];
    }

    public function filters(): array
    {
        return [
            'FACT',
        ];
    }

    public function sorts(): array
    {
        return [
            'FACT',
        ];
    }

    public function unique(): array
    {
        return ['FACT', 'CRE'];
    }

    public static function schema(): array
    {
        return [
            'aflgebr' => ['string', 'AFLGEBR'],
            'bedr' => ['float', 'BEDR'],
            'bedrbkrttebetval' => ['float', 'BEDRBKRTTEBETVAL'],
            'bedrbtw' => ['float', 'BEDRBTW'],
            'bedrbtwval' => ['float', 'BEDRBTWVAL'],
            'bedrgrek' => ['float', 'BEDRGREK'],
            'bedrkb' => ['float', 'BEDRKB'],
            'bedrkbval' => ['float', 'BEDRKBVAL'],
            'bedroorsprval' => ['float', 'BEDROORSPRVAL'],
            'bedrtebet' => ['float', 'BEDRTEBET'],
            'bedrval' => ['float', 'BEDRVAL'],
            'bet' => ['float', 'BET'],
            'betgrek' => ['float', 'BETGREK'],
            'betval' => ['float', 'BETVAL'],
            'betwist' => ['bool', 'BETWIST'],
            'cre' => ['int', 'CRE'],
            'creditnotacre' => ['int', 'CREDITNOTACRE'],
            'creditnotafact' => ['string', 'CREDITNOTAFACT'],
            'dat' => ['string', 'DAT'],
            'datlstbet' => ['string', 'DATLSTBET'],
            'datverv' => ['string', 'DATVERV'],
            'fact' => ['string', 'FACT'],
            'fiat' => ['bool', 'FIAT'],
            'fiatinkoop' => ['string', 'FIATINKOOP'],
            'incasso' => ['bool', 'INCASSO'],
            'kdr' => ['int', 'KDR'],
            'kenm' => ['string', 'KENM'],
            'kenmbatch' => ['string', 'KENMBATCH'],
            'kpl' => ['int', 'KPL'],
            'omschr' => ['string', 'OMSCHR'],
            'opm' => ['string', 'OPM'],
            'saldo' => ['float', 'SALDO'],
            'saldogrek' => ['float', 'SALDOGREK'],
            'saldooorsprval' => ['float', 'SALDOOORSPRVAL'],
            'saldoval' => ['float', 'SALDOVAL'],
            'voldaan' => ['bool', 'VOLDAAN'],
        ];
    }
}
