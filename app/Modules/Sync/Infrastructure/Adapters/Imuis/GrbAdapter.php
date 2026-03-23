<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\GrbMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class GrbAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return GrbMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::GRB->name;
    }

    public function fields(): array
    {
        return [
            'AANTADM', 'ACT', 'ACTNR', 'ACTTYPE', 'ACTVANAF', 'AFSCHRMETH', 'APBL', 'BEOORCD', 'BLOK', 'BTW',
            'DC', 'DOSSIER', 'DOSSVERPL', 'GRBAFSCHRBALANS', 'GRBAFSCHRBALCUM', 'GRBAFSCHRVW', 'GRBDESINV',
            'GRBDESINVAFS', 'GRBDESINVVERLIES', 'GRBDESINVWINST', 'GRBHERINVRES', 'GRBOPBRDESINV', 'HERW',
            'ISAFL', 'ISAFLRAPPORTAGE', 'ISPRIVE', 'ISRC', 'KDR', 'KDRVERPL', 'KPL', 'KPLVERPL', 'LOOPTIJD',
            'MAPPING', 'NIVO', 'NR', 'OMSCHR', 'OPM', 'RCADM', 'RCTEGREK', 'RESTGVHERINV', 'SELCD', 'RGS',
            'SLUITREK', 'SPECGRBMUT', 'SPECPRIVE', 'STAMRECHTGRBAP', 'STAMRECHTGRBBL', 'STAMRECHTJN',
            'STAMRECHTJR', 'STAMRECHTJR2', 'STAMRECHTPERC', 'STAMRECHTPN', 'STAMRECHTPN2', 'STAMRECHTSOORT',
            'STAMRECHTSOORT2', 'TERM', 'TONEN', 'TRANSIT', 'VAL', 'VERDICHT', 'VERSL', 'VERSL2', 'VJP', 'XBRL',
            'ZKSL',
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
            'aantadm' => ['bool', 'AANTADM'],
            'act' => ['string', 'ACT'],
            'actnr' => ['int', 'ACTNR'],
            'acttype' => ['string', 'ACTTYPE'],
            'actvanaf' => ['float', 'ACTVANAF'],
            'afschrmeth' => ['string', 'AFSCHRMETH'],
            'apbl' => ['string', 'APBL'],
            'beoorcd' => ['string', 'BEOORCD'],
            'blok' => ['bool', 'BLOK'],
            'btw' => ['int', 'BTW'],
            'dc' => ['string', 'DC'],
            'dossier' => ['string', 'DOSSIER'],
            'dossverpl' => ['bool', 'DOSSVERPL'],
            'grbafschrbalans' => ['int', 'GRBAFSCHRBALANS'],
            'grbafschrbalcum' => ['int', 'GRBAFSCHRBALCUM'],
            'grbafschrvw' => ['int', 'GRBAFSCHRVW'],
            'grbdesinv' => ['int', 'GRBDESINV'],
            'grbdesinvafs' => ['int', 'GRBDESINVAFS'],
            'grbdesinvverlies' => ['int', 'GRBDESINVVERLIES'],
            'grbdesinvwinst' => ['int', 'GRBDESINVWINST'],
            'grbherinvres' => ['int', 'GRBHERINVRES'],
            'grbopbrdesinv' => ['int', 'GRBOPBRDESINV'],
            'herw' => ['bool', 'HERW'],
            'isafl' => ['string', 'ISAFL'],
            'isaflrapportage' => ['string', 'ISAFLRAPPORTAGE'],
            'isprive' => ['string', 'ISPRIVE'],
            'isrc' => ['string', 'ISRC'],
            'kdr' => ['int', 'KDR'],
            'kdrverpl' => ['string', 'KDRVERPL'],
            'kpl' => ['int', 'KPL'],
            'kplverpl' => ['string', 'KPLVERPL'],
            'looptijd' => ['int', 'LOOPTIJD'],
            'mapping' => ['string', 'MAPPING'],
            'nivo' => ['int', 'NIVO'],
            'nr' => ['int', 'NR'],
            'omschr' => ['string', 'OMSCHR'],
            'opm' => ['string', 'OPM'],
            'rcadm' => ['int', 'RCADM'],
            'rctegrek' => ['int', 'RCTEGREK'],
            'restgvherinv' => ['string', 'RESTGVHERINV'],
            'selcd' => ['string', 'SELCD'],
            'rgs' => ['string', 'RGS'],
            'sluitrek' => ['string', 'SLUITREK'],
            'specgrbmut' => ['string', 'SPECGRBMUT'],
            'specprive' => ['string', 'SPECPRIVE'],
            'stamrechtgrbap' => ['int', 'STAMRECHTGRBAP'],
            'stamrechtgrbbl' => ['int', 'STAMRECHTGRBBL'],
            'stamrechtjn' => ['string', 'STAMRECHTJN'],
            'stamrechtjr' => ['int', 'STAMRECHTJR'],
            'stamrechtjr2' => ['int', 'STAMRECHTJR2'],
            'stamrechtperc' => ['float', 'STAMRECHTPERC'],
            'stamrechtpn' => ['int', 'STAMRECHTPN'],
            'stamrechtpn2' => ['int', 'STAMRECHTPN2'],
            'stamrechtsoort' => ['string', 'STAMRECHTSOORT'],
            'stamrechtsoort2' => ['string', 'STAMRECHTSOORT2'],
            'term' => ['string', 'TERM'],
            'tonen' => ['string', 'TONEN'],
            'transit' => ['string', 'TRANSIT'],
            'val' => ['string', 'VAL'],
            'verdicht' => ['string', 'VERDICHT'],
            'versl' => ['int', 'VERSL'],
            'versl2' => ['int', 'VERSL2'],
            'vjp' => ['bool', 'VJP'],
            'xbrl' => ['int', 'XBRL'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
