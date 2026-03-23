<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\DeboppMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class DeboppAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return DeboppMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::DEBOPP->name;
    }

    public function fields(): array
    {
        return [
            'AANM', 'AANTINC', 'BEDR', 'BEDRBETKORT', 'BEDRBETKORTVAL', 'BEDRBETKRTTEINC',
            'BEDRBKRTTEINCVAL', 'BEDRBTW', 'BEDRBTWVAL', 'BEDRKB', 'BEDRKBVAL', 'BEDROORSPRVAL',
            'BEDRVAL', 'BET', 'BETALER', 'BETCOND', 'BETREGDEB', 'BETREGFACT', 'BETVAL',
            'BETWIST', 'BNKREK', 'CREDITNOTADEB', 'CREDITNOTAFACT', 'DAT', 'DATLSTAANM',
            'DATLSTBET', 'DATUITV', 'DATVERV', 'DEB', 'DEBORDER', 'FACT', 'KDR', 'KENM',
            'KPL', 'MDT', 'OMSCHR', 'OPM', 'SALDO', 'SALDOOORSPRVAL', 'SALDOVAL', 'UITHANDEN',
            'VAL', 'VOLDAAN',
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

    public function unique(): string
    {
        return 'FACT';
    }

    public static function schema(): array
    {
        return [
            'aanm' => ['int', 'AANM'],
            'aantinc' => ['int', 'AANTINC'],
            'bedr' => ['float', 'BEDR'],
            'bedrbetkort' => ['float', 'BEDRBETKORT'],
            'bedrbetkortval' => ['float', 'BEDRBETKORTVAL'],
            'bedrbetkrtteinc' => ['float', 'BEDRBETKRTTEINC'],
            'bedrbkrtteincval' => ['float', 'BEDRBKRTTEINCVAL'],
            'bedrbtw' => ['float', 'BEDRBTW'],
            'bedrbtwval' => ['float', 'BEDRBTWVAL'],
            'bedrkb' => ['float', 'BEDRKB'],
            'bedrkbval' => ['float', 'BEDRKBVAL'],
            'bedroorsprval' => ['float', 'BEDROORSPRVAL'],
            'bedrval' => ['float', 'BEDRVAL'],
            'bet' => ['float', 'BET'],
            'betaler' => ['int', 'BETALER'],
            'betcond' => ['int', 'BETCOND'],
            'betregdeb' => ['int', 'BETREGDEB'],
            'betregfact' => ['string', 'BETREGFACT'],
            'betval' => ['float', 'BETVAL'],
            'betwist' => ['bool', 'BETWIST'],
            'bnkrek' => ['string', 'BNKREK'],
            'creditnotadeb' => ['int', 'CREDITNOTADEB'],
            'creditnotafact' => ['string', 'CREDITNOTAFACT'],
            'dat' => ['string', 'DAT'],
            'datlstaanm' => ['string', 'DATLSTAANM'],
            'datlstbet' => ['string', 'DATLSTBET'],
            'datuitv' => ['string', 'DATUITV'],
            'datverv' => ['string', 'DATVERV'],
            'deb' => ['int', 'DEB'],
            'deborder' => ['int', 'DEBORDER'],
            'fact' => ['string', 'FACT'],
            'kdr' => ['int', 'KDR'],
            'kenm' => ['string', 'KENM'],
            'kpl' => ['int', 'KPL'],
            'mdt' => ['string', 'MDT'],
            'omschr' => ['string', 'OMSCHR'],
            'opm' => ['string', 'OPM'],
            'saldo' => ['float', 'SALDO'],
            'saldooorsprval' => ['float', 'SALDOOORSPRVAL'],
            'saldoval' => ['float', 'SALDOVAL'],
            'uithanden' => ['string', 'UITHANDEN'],
            'val' => ['string', 'VAL'],
            'voldaan' => ['bool', 'VOLDAAN'],
        ];
    }
}
