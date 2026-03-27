<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\DebMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class DebAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return DebMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::DEB->name;
    }

    public function fields(): array
    {
        return [
            'AANHEF', 'AANM', 'AANMAFDRUK', 'AANMVAST', 'ADRES', 'ADRESSERING', 'BETALER', 'BETCOND',
            'BLOK', 'BLOKDECLVA', 'BLOKVRKVA', 'BNKBNKREK', 'BNKBNKREK2', 'BNKGIRO', 'BNKGREK', 'BNKIBAN',
            'BNKIBAN2', 'BNKREK', 'BNKREK2', 'BNKREKNUM', 'BNKREKNUM2', 'BNKSRTINC', 'BTWNR', 'BTWPL',
            'DATBTWNR', 'DATKLANTAF', 'DATKLANTSINDS', 'DATKRLIMTM', 'DATKRLIMVAN', 'DATKVKUITTR',
            'DATLSTAANM', 'DATLSTBET', 'DATLSTFACT', 'DATOPRICHTING', 'DECBUDVERPL', 'DECLTOEL', 'EANNR',
            'EMAIL', 'EMAILMAILINGJN', 'EXTAANBRENGREL', 'EXTAANBRENGZKSL', 'FACTAFDRUK', 'FACTORING',
            'FACVRKNAARDEB', 'FAX', 'GEBRSTAFFEL', 'GEBRVERKKOSTPR', 'GIRO', 'GIROIBAN', 'GIRONAAM', 'GIRONUM',
            'GREK', 'GREKIBAN', 'GREKNUM', 'GRPDEB', 'HEEFTSALDO', 'HNR', 'HNRTV', 'HOMEPAGE', 'INCSELAFDRUK',
            'INKCOMB', 'JRDECLTM', 'JRDECLVAN', 'KDR', 'KENMOPP', 'KIXCD', 'KLANTAFTEKST', 'KLANTSINDSTEKST',
            'KPL', 'KRLIM', 'KVKNR', 'KVKPLAATS', 'LAAGSTEBEDR', 'LAND', 'LEVCOND', 'MEDEW', 'MEDEWAANBRENG',
            'MEDEWDEC', 'MEDEWFISCAAL', 'MEDEWLOON', 'MEDEWVENNOOT', 'MOBIEL', 'NAAM', 'NAAM2', 'NR',
            'NRBIJDEB', 'NRRIT', 'OFFAFDRUK', 'OPDRWZ', 'OPM', 'ORDBEVAFDRUK', 'ORDERCOMPLEET', 'ORDSRT',
            'PAKBEMAIL', 'PERCGREK', 'PLAATS', 'PLM', 'PNDECLTM', 'PNDECLVAN', 'POSTCD', 'PRG', 'PROSP',
            'PRSLST', 'RAYON', 'RIT', 'RVORM', 'SALDO', 'SLUITREK', 'STATNAAM', 'STATPLAATS', 'STRAAT',
            'TAAL', 'TEGREK', 'TEL', 'TELPRIVE', 'TEONTVINC', 'TERM', 'TERMIJNFACT', 'VAL', 'VASTECTRDATUM',
            'VERKOPER', 'VERR', 'VERZFACT', 'VERZWZ', 'VOORS', 'VRIJVELD1', 'VRIJVELD2', 'VRIJVELD3',
            'VRIJVELD4', 'VRIJVELD5', 'ZKSL',
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
            'aanhef' => ['string', 'AANHEF'],
            'aanm' => ['bool', 'AANM'],
            'aanmafdruk' => ['string', 'AANMAFDRUK'],
            'aanmvast' => ['string', 'AANMVAST'],
            'adres' => ['string', 'ADRES'],
            'adressering' => ['string', 'ADRESSERING'],
            'betaler' => ['int', 'BETALER'],
            'betcond' => ['int', 'BETCOND'],
            'blok' => ['bool', 'BLOK'],
            'blokdeclva' => ['string', 'BLOKDECLVA'],
            'blokvrkva' => ['string', 'BLOKVRKVA'],
            'bnkbnkrek' => ['string', 'BNKBNKREK'],
            'bnkbnkrek2' => ['string', 'BNKBNKREK2'],
            'bnkgiro' => ['string', 'BNKGIRO'],
            'bnkgrek' => ['string', 'BNKGREK'],
            'bnkiban' => ['string', 'BNKIBAN'],
            'bnkiban2' => ['string', 'BNKIBAN2'],
            'bnkrek' => ['string', 'BNKREK'],
            'bnkrek2' => ['string', 'BNKREK2'],
            'bnkreknum' => ['int', 'BNKREKNUM'],
            'bnkreknum2' => ['int', 'BNKREKNUM2'],
            'bnksrtinc' => ['string', 'BNKSRTINC'],
            'btwnr' => ['string', 'BTWNR'],
            'btwpl' => ['string', 'BTWPL'],
            'datbtwnr' => ['string', 'DATBTWNR'],
            'datklantaf' => ['string', 'DATKLANTAF'],
            'datklantsinds' => ['string', 'DATKLANTSINDS'],
            'datkrlimtm' => ['string', 'DATKRLIMTM'],
            'datkrlimvan' => ['string', 'DATKRLIMVAN'],
            'datkvkuittr' => ['string', 'DATKVKUITTR'],
            'datlstaanm' => ['string', 'DATLSTAANM'],
            'datlstbet' => ['string', 'DATLSTBET'],
            'datlstfact' => ['string', 'DATLSTFACT'],
            'datoprichting' => ['string', 'DATOPRICHTING'],
            'decbudverpl' => ['string', 'DECBUDVERPL'],
            'decltoel' => ['string', 'DECLTOEL'],
            'eannr' => ['int', 'EANNR'],
            'email' => ['string', 'EMAIL'],
            'emailmailingjn' => ['string', 'EMAILMAILINGJN'],
            'extaanbrengrel' => ['int', 'EXTAANBRENGREL'],
            'extaanbrengzksl' => ['string', 'EXTAANBRENGZKSL'],
            'factafdruk' => ['string', 'FACTAFDRUK'],
            'factoring' => ['bool', 'FACTORING'],
            'facvrknaardeb' => ['string', 'FACVRKNAARDEB'],
            'fax' => ['string', 'FAX'],
            'gebrstaffel' => ['string', 'GEBRSTAFFEL'],
            'gebrverkkostpr' => ['string', 'GEBRVERKKOSTPR'],
            'giro' => ['string', 'GIRO'],
            'giroiban' => ['string', 'GIROIBAN'],
            'gironaam' => ['string', 'GIRONAAM'],
            'gironum' => ['int', 'GIRONUM'],
            'grek' => ['string', 'GREK'],
            'grekiban' => ['string', 'GREKIBAN'],
            'greknum' => ['int', 'GREKNUM'],
            'grpdeb' => ['int', 'GRPDEB'],
            'heeftsaldo' => ['bool', 'HEEFTSALDO'],
            'hnr' => ['int', 'HNR'],
            'hnrtv' => ['string', 'HNRTV'],
            'homepage' => ['string', 'HOMEPAGE'],
            'incselafdruk' => ['string', 'INCSEALAFDRUK'],
            'inkcomb' => ['int', 'INKCOMB'],
            'jrdecltm' => ['int', 'JRDECLTM'],
            'jrdeclvan' => ['int', 'JRDECLVAN'],
            'kdr' => ['int', 'KDR'],
            'kenmopp' => ['string', 'KENMOPP'],
            'kixcd' => ['string', 'KIXCD'],
            'klantaftekst' => ['string', 'KLANTAFTEKST'],
            'klantsindstekst' => ['string', 'KLANTSINDSTEKST'],
            'kpl' => ['int', 'KPL'],
            'krlim' => ['float', 'KRLIM'],
            'kvknr' => ['string', 'KVKNR'],
            'kvkplaats' => ['string', 'KVKPLAATS'],
            'laagstebedr' => ['bool', 'LAAGSTEBEDR'],
            'land' => ['string', 'LAND'],
            'levcond' => ['string', 'LEVCOND'],
            'medew' => ['string', 'MEDEW'],
            'medewaanbreng' => ['string', 'MEDEWAANBRENG'],
            'medewdec' => ['string', 'MEDEWDEC'],
            'medewfiscaal' => ['string', 'MEDEWFISCAAL'],
            'medewloon' => ['string', 'MEDEWLOON'],
            'medewvennoot' => ['string', 'MEDEWVENNOOT'],
            'mobiel' => ['string', 'MOBIEL'],
            'naam' => ['string', 'NAAM'],
            'naam2' => ['string', 'NAAM2'],
            'nr' => ['int', 'NR'],
            'nrbijdeb' => ['string', 'NRBIJDEB'],
            'nrrit' => ['int', 'NRRIT'],
            'offafdruk' => ['string', 'OFFAFDRUK'],
            'opdrwz' => ['string', 'OPDRWZ'],
            'opm' => ['string', 'OPM'],
            'ordbevafdruk' => ['string', 'ORDBEVAFDRUK'],
            'ordercompleet' => ['string', 'ORDERCOMPLETE'],
            'ordsrt' => ['string', 'ORDSRT'],
            'pakbemail' => ['string', 'PAKBEMAIL'],
            'percgrek' => ['float', 'PERCGREK'],
            'plaats' => ['string', 'PLAATS'],
            'plm' => ['float', 'PLM'],
            'pndecltm' => ['int', 'PNDECLTM'],
            'pndeclvan' => ['int', 'PNDECLVAN'],
            'postcd' => ['string', 'POSTCD'],
            'prg' => ['string', 'PRG'],
            'prosp' => ['int', 'PROSP'],
            'prslst' => ['string', 'PRSLST'],
            'rayon' => ['int', 'RAYON'],
            'rit' => ['int', 'RIT'],
            'rvorm' => ['string', 'RVORM'],
            'saldo' => ['float', 'SALDO'],
            'sluitrek' => ['int', 'SLUITREK'],
            'statnaam' => ['string', 'STATNAAM'],
            'statplaats' => ['string', 'STATPLAATS'],
            'straat' => ['string', 'STRAAT'],
            'taal' => ['string', 'TAAL'],
            'tegrek' => ['int', 'TEGREK'],
            'tel' => ['string', 'TEL'],
            'telprive' => ['string', 'TELPRIVE'],
            'teontvinc' => ['float', 'TEONTVINC'],
            'term' => ['string', 'TERM'],
            'termijnfact' => ['string', 'TERMIJNFACT'],
            'val' => ['string', 'VAL'],
            'vastectrdatum' => ['string', 'VASTECTRDATUM'],
            'verkoper' => ['string', 'VERKOPER'],
            'verr' => ['bool', 'VERR'],
            'verzfact' => ['string', 'VERZFACT'],
            'verzwz' => ['string', 'VERZWZ'],
            'voors' => ['string', 'VOORS'],
            'vrijveld1' => ['string', 'VRIJVELD1'],
            'vrijveld2' => ['string', 'VRIJVELD2'],
            'vrijveld3' => ['string', 'VRIJVELD3'],
            'vrijveld4' => ['string', 'VRIJVELD4'],
            'vrijveld5' => ['string', 'VRIJVELD5'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
