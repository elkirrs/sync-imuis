<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\CreMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class CreAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return CreMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::CRE->name;
    }

    public function fields(): array
    {
        return [
            'AANHEF', 'ADRES', 'ADRESSERING', 'BETCOND', 'BETKENMVERPL', 'BETSELAFDRUK', 'BLOK', 'BLOKINKVA',
            'BNKBNKREK', 'BNKGREK', 'BNKGIRO', 'BNKIBAN', 'BNKREK', 'BNKREKNUM', 'BNKSRTBET', 'BTWNR', 'BTWPL',
            'BTWSTATNAAM', 'CERTSLEUTEL', 'DAGBINK', 'DATAANGEM', 'DATBTWNR', 'DATKRLIMTM', 'DATKRLIMVAN',
            'DATKVKUITTR', 'DATLSTBET', 'DATLSTFACT', 'DEB', 'ECONNECTID', 'EMAIL', 'EMAILMAILINGJN', 'FAX',
            'FRANCO', 'GIRO', 'GIROIBAN', 'GIRONAAM', 'GIRONUM', 'GPSCOORDB', 'GPSCOORDL', 'GREK', 'GREKIBAN',
            'GREKNAAM', 'HEEFTSALDO', 'HNR', 'HNRTV', 'HOMEPAGE', 'INKOPER', 'KDR', 'KPL', 'KRLIM', 'KVKNR',
            'KVKPLAATS', 'KVKSTATNAAM', 'LAND', 'LEVCOND', 'LEVSRT', 'LEVTIJD', 'MEDEW', 'MEDEWFIATBET',
            'MEDEWFIATINKOOP', 'MOBIEL', 'NAAM', 'NAAM2', 'NAAMUBL', 'NR', 'NRBIJCRE', 'OIN', 'OPDRWZ', 'OPM',
            'OPMINT', 'ORDBEVAFDRUK', 'PLAATS', 'POSTCD', 'PRSLST', 'RVORM', 'SALDO', 'SJABLOON', 'SLUITREK',
            'STRAAT', 'TAAL', 'TEBETALEN', 'TEGREK', 'TEL', 'TELPRIVE', 'UBLDOORBOEKEN', 'VAL', 'VERZWZ',
            'VRIJVELD1', 'VRIJVELD2', 'ZKSL', 'ZKSLEXT',
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
            'aanhef' => ['string', 'AANHEF'],
            'adres' => ['string', 'ADRES'],
            'adressering' => ['string', 'ADRESSERING'],
            'betcond' => ['int', 'BETCOND'],
            'betkenmverpl' => ['string', 'BETKENMVERPL'],
            'betselafdruk' => ['string', 'BETSELAFDRUK'],
            'blok' => ['bool', 'BLOK'],
            'blokinkva' => ['string', 'BLOKINKVA'],
            'bnkbnkrek' => ['string', 'BNKBNKREK'],
            'bnkgrek' => ['string', 'BNKGREK'],
            'bnkgiro' => ['string', 'BNKGIRO'],
            'bnkiban' => ['string', 'BNKIBAN'],
            'bnkrek' => ['string', 'BNKREK'],
            'bnkreknum' => ['int', 'BNKREKNUM'],
            'bnksrtbet' => ['string', 'BNKSRTBET'],
            'btwnr' => ['string', 'BTWNR'],
            'btwpl' => ['string', 'BTWPL'],
            'btwstatnaam' => ['string', 'BTWSTATNAAM'],
            'certsleutel' => ['string', 'CERTSLEUTEL'],
            'dagbink' => ['int', 'DAGBINK'],
            'dataangem' => ['string', 'DATAANGEM'],
            'datbtwnr' => ['string', 'DATBTWNR'],
            'datkrlimtm' => ['string', 'DATKRLIMTM'],
            'datkrlimvan' => ['string', 'DATKRLIMVAN'],
            'datkvkuittr' => ['string', 'DATKVKUITTR'],
            'datlstbet' => ['string', 'DATLSTBET'],
            'datlstfact' => ['string', 'DATLSTFACT'],
            'deb' => ['int', 'DEB'],
            'econnectid' => ['string', 'ECONNECTID'],
            'email' => ['string', 'EMAIL'],
            'emailmailingjn' => ['string', 'EMAILMAILINGJN'],
            'fax' => ['string', 'FAX'],
            'franco' => ['float', 'FRANCO'],
            'giro' => ['string', 'GIRO'],
            'giroiban' => ['string', 'GIROIBAN'],
            'gironaam' => ['string', 'GIRONAAM'],
            'gironum' => ['int', 'GIRONUM'],
            'gpscoordb' => ['string', 'GPSCOORDB'],
            'gpscoordl' => ['string', 'GPSCOORDL'],
            'grek' => ['string', 'GREK'],
            'grekiban' => ['string', 'GREKIBAN'],
            'greknaam' => ['string', 'GREKNAAM'],
            'heeftsaldo' => ['bool', 'HEEFTSALDO'],
            'hnr' => ['int', 'HNR'],
            'hnrtv' => ['string', 'HNRTV'],
            'homepage' => ['string', 'HOMEPAGE'],
            'inkoper' => ['string', 'INKOPER'],
            'kdr' => ['int', 'KDR'],
            'kpl' => ['int', 'KPL'],
            'krlim' => ['float', 'KRLIM'],
            'kvknr' => ['string', 'KVKNR'],
            'kvkplaats' => ['string', 'KVKPLAATS'],
            'kvkstatnaam' => ['string', 'KVKSTATNAAM'],
            'land' => ['string', 'LAND'],
            'levcond' => ['string', 'LEVCOND'],
            'levsrt' => ['string', 'LEVSRT'],
            'levtijd' => ['int', 'LEVTijd'],
            'medew' => ['string', 'MEDEW'],
            'medewfiatbet' => ['string', 'MEDEWFIATBET'],
            'medewfiatinkoop' => ['string', 'MEDEWFIATINKOOP'],
            'mobiel' => ['string', 'MOBIEL'],
            'naam' => ['string', 'NAAM'],
            'naam2' => ['string', 'NAAM2'],
            'naamubl' => ['string', 'NAAMUBL'],
            'nr' => ['int', 'NR'],
            'nrbijcre' => ['string', 'NRBIJCRE'],
            'oin' => ['string', 'OIN'],
            'opdrwz' => ['string', 'OPDRWZ'],
            'opm' => ['string', 'OPM'],
            'opmint' => ['string', 'OPMINT'],
            'ordbevafdruk' => ['string', 'ORDBEVAFDRUK'],
            'plaats' => ['string', 'PLAATS'],
            'postcd' => ['string', 'POSTCD'],
            'prslst' => ['string', 'PRSLST'],
            'rvorm' => ['string', 'RVORM'],
            'saldo' => ['float', 'SALDO'],
            'sjabloon' => ['string', 'SJABLOON'],
            'sluitrek' => ['int', 'SLUITREK'],
            'straat' => ['string', 'STRAAT'],
            'taal' => ['string', 'TAAL'],
            'tebetalen' => ['float', 'TEBETALEN'],
            'tegrek' => ['int', 'TEGREK'],
            'tel' => ['string', 'TEL'],
            'telprive' => ['string', 'TELPRIVE'],
            'ubldoorboeken' => ['string', 'UBLDOORBOEKEN'],
            'val' => ['string', 'VAL'],
            'verzwz' => ['string', 'VERZWZ'],
            'vrijveld1' => ['string', 'VRIJVELD1'],
            'vrijveld2' => ['string', 'VRIJVELD2'],
            'zksl' => ['string', 'ZKSL'],
            'zkslext' => ['string', 'ZKSLEXT'],
        ];
    }
}
