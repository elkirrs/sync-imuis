<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\OrdkopMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class OrdkopAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return OrdkopMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::ORDKOP->name;
    }

    public function fields(): array
    {
        return [
            'BEDRBETKORT', 'BEDRBETKORTINCL', 'BEDRBINEU', 'BEDRBUIEU', 'BEDRFACT', 'BEDRGEEN', 'BEDRGREK', 'BEDRHOOG',
            'BEDRINCLBINEU', 'BEDRINCLBUIEU', 'BEDRINCLFACT', 'BEDRINCLGEEN',
            'BEDRINCLHOOG', 'BEDRINCLLAAG', 'BEDRINCLOPEN', 'BEDRINCLTOT', 'BEDRINCLVERLEGD',
            'BEDRKB', 'BEDRKBINCL', 'BEDRKOSTPR', 'BEDRLAAG', 'BEDROPEN', 'BEDRORDKST', 'BEDRORDKSTFACTIN',
            'BEDRORDKSTGEFACT', 'BEDRORDKSTGEWIJZ', 'BEDRORDKSTINCL', 'BEDRTOT', 'BEDRVERLEGD',
            'BEDRVRACHTKST', 'BEDRVRACHTKSTWZ', 'BEDRVRKSTFACTINC', 'BEDRVRKSTGEFACT', 'BEDRVRKSTINCL', 'BETALER',
            'BETCODE', 'BETCOND', 'BLOK', 'BTWPL', 'DAT', 'DATLEV', 'DATLEVGEWIJZ', 'DATLEVUITERST',
            'DATORDBEV', 'DATPICK', 'DATVAST', 'DATVRWRK', 'DEB', 'EXTORDNR', 'GEBRORDBEV', 'GEFACT', 'INCASSO',
            'ISINCL', 'KDR', 'KENM', 'KPL', 'LEVCOND', 'MAG', 'MDT', 'MEDEWVAST', 'NR', 'NRRIT',
            'OPDRWZ', 'OPM', 'ORDERCOMPLEET', 'ORDSRT', 'PERCBETKORT', 'PERCGREK', 'PERCKB', 'PERCLOON',
            'PRSLST', 'RIT', 'SELCD', 'TAAL', 'TEFACT', 'VAL', 'VERKOPER', 'VERVDGN', 'VERZADRES', 'VERZADRESSERING',
            'VERZCNTREL', 'VERZCNTZKSL', 'VERZDEB', 'VERZEMAIL', 'VERZHNR', 'VERZHNRTV', 'VERZLAND', 'VERZNAAM',
            'VERZNAAM2', 'VERZPLAATS', 'VERZPOSTCD', 'VERZSTRAAT', 'VERZTEL', 'VERZWZ', 'VERZZKSL', 'VOLUME',

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
            'bedrbetkort' => ['float', 'BEDRBETKORT'],
            'bedrbetkortincl' => ['float', 'BEDRBETKORTINCL'],
            'bedrbineu' => ['float', 'BEDRBINEU'],
            'bedrbuieu' => ['float', 'BEDRBUIEU'],
            'bedrfact' => ['float', 'BEDRFACT'],
            'bedrgeen' => ['float', 'BEDRGEEN'],
            'bedrgrek' => ['float', 'BEDRGREK'],
            'bedrhoog' => ['float', 'BEDRHOOG'],
            'bedrinclbineu' => ['float', 'BEDRINCLBINEU'],
            'bedrinclbuieu' => ['float', 'BEDRINCLBUIEU'],
            'bedrinclfact' => ['float', 'BEDRINCLFACT'],
            'bedrinclgeen' => ['float', 'BEDRINCLGEEN'],
            'bedrinclhoog' => ['float', 'BEDRINCLHOOG'],
            'bedrincllaag' => ['float', 'BEDRINCLLAAG'],
            'bedrinclopen' => ['float', 'BEDRINCLOPEN'],
            'bedrincltot' => ['float', 'BEDRINCLTOT'],
            'bedrinclverlegd' => ['float', 'BEDRINCLVERLEGD'],
            'bedrkb' => ['float', 'BEDRKB'],
            'bedrkbincl' => ['float', 'BEDRKBINCL'],
            'bedrkostpr' => ['float', 'BEDRKOSTPR'],
            'bedrlaag' => ['float', 'BEDRLAAG'],
            'bedropen' => ['float', 'BEDROPEN'],
            'bedrordkst' => ['float', 'BEDRORDKST'],
            'bedrordkstfactin' => ['float', 'BEDRORDKSTFACTIN'],
            'bedrordkstgefact' => ['float', 'BEDRORDKSTGEFACT'],
            'bedrordkstgewijz' => ['string', 'BEDRORDKSTGEWIJZ'],
            'bedrordkstincl' => ['float', 'BEDRORDKSTINCL'],
            'bedrtot' => ['float', 'BEDRTOT'],
            'bedrverlegd' => ['float', 'BEDRVERLEGD'],
            'bedrvrachtkst' => ['float', 'BEDRVRACHTKST'],
            'bedrvrachtkstwz' => ['string', 'BEDRVRACHTKSTWZ'],
            'bedrvrkstfactinc' => ['float', 'BEDRVRKSTFACTINC'],
            'bedrvrkstgefact' => ['float', 'BEDRVRKSTGEFACT'],
            'bedrvrkstincl' => ['float', 'BEDRVRKSTINCL'],
            'betaler' => ['int', 'BETALER'],
            'betcode' => ['string', 'BETCODE'],
            'betcond' => ['int', 'BETCOND'],
            'blok' => ['bool', 'BLOK'],
            'btwpl' => ['string', 'BTWPL'],
            'dat' => ['string', 'DAT'],
            'datlev' => ['string', 'DATLEV'],
            'datlevgewijz' => ['string', 'DATLEVGEWIJZ'],
            'datlevuiterst' => ['string', 'DATLEVUITERST'],
            'datordbev' => ['string', 'DATORDBEV'],
            'datpick' => ['string', 'DATPICK'],
            'datvast' => ['string', 'DATVAST'],
            'datvrwrk' => ['string', 'DATVRWRK'],
            'deb' => ['int', 'DEB'],
            'extordnr' => ['int', 'EXTORDNR'],
            'gebrordbev' => ['string', 'GEBRORDBEV'],
            'gefact' => ['string', 'GEFACT'],
            'incasso' => ['string', 'INCASSO'],
            'isincl' => ['string', 'ISINCL'],
            'kdr' => ['int', 'KDR'],
            'kenm' => ['string', 'KENM'],
            'kpl' => ['int', 'KPL'],
            'levcond' => ['string', 'LEVCOND'],
            'mag' => ['int', 'MAG'],
            'mdt' => ['string', 'MDT'],
            'medewvast' => ['string', 'MEDEWVAST'],
            'nr' => ['int', 'NR'],
            'nrrit' => ['int', 'NRRIT'],
            'opdrwz' => ['string', 'OPDRWZ'],
            'opm' => ['string', 'OPM'],
            'ordercompleet' => ['string', 'ORDERCOMPLETE'],
            'ordsrt' => ['string', 'ORDSRT'],
            'percbetkort' => ['float', 'PERCBETKORT'],
            'percgrek' => ['float', 'PERCGREK'],
            'perckb' => ['float', 'PERCKB'],
            'percloon' => ['float', 'PERCLOON'],
            'prslst' => ['string', 'PRSLST'],
            'rit' => ['int', 'RIT'],
            'selcd' => ['string', 'SELCD'],
            'taal' => ['string', 'TAAL'],
            'tefact' => ['string', 'TEFACT'],
            'val' => ['string', 'VAL'],
            'verkoper' => ['string', 'VERKOPER'],
            'vervdgn' => ['int', 'VERVDGN'],
            'verzadres' => ['string', 'VERZADRES'],
            'verzadressering' => ['string', 'VERZADRESSERING'],
            'verzcntrel' => ['int', 'VERZCNTREL'],
            'verzcntzksl' => ['string', 'VERZCNTZKSL'],
            'verzdeb' => ['int', 'VERZDEB'],
            'verzemail' => ['string', 'VERZEMAIL'],
            'verzhnr' => ['int', 'VERZHNR'],
            'verzhnrtv' => ['string', 'VERZHNRTV'],
            'verzland' => ['string', 'VERZLAND'],
            'verznaam' => ['string', 'VERZNAAM'],
            'verznaam2' => ['string', 'VERZNAAM2'],
            'verzplaats' => ['string', 'VERZPLAATS'],
            'verzpostcd' => ['string', 'VERZPOSTCD'],
            'verzstraat' => ['string', 'VERZSTRAAT'],
            'verztel' => ['string', 'VERZTEL'],
            'verzwz' => ['string', 'VERZWZ'],
            'verzzksl' => ['string', 'VERZZKSL'],
            'volume' => ['float', 'VOLUME'],
        ];
    }
}
