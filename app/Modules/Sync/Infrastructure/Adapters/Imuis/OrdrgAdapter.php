<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\OrdrgMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class OrdrgAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return OrdrgMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::ORDRG->name;
    }

    public function fields(): array
    {
        return [
            'AANT', 'AANTBACKORD', 'AANTGEFACT', 'AANTGELEV', 'AANTPICKBON', 'AANTTEFACT', 'AANTTELEV',
            'AFDRFACT', 'AFDRORDBEV', 'AFDRPICK', 'AFDRVERZ', 'ART', 'ARTGRP', 'BEDR', 'BEDRINCL',
            'BETALER', 'BLOK', 'BTWSRT', 'COLLI', 'DAT', 'DATFACT', 'DATLEV', 'DATLEVGEWIJZ', 'DATORDBEV',
            'DEB', 'EENH', 'EENHPRS', 'EMBALLAGERG', 'EXTORDNR', 'FACT', 'GEBRORDBEV', 'INHOUD', 'ISTEKSTRG',
            'KDR', 'KOSTPR', 'KPL', 'LEVERCORR', 'MAG', 'OMSCHR', 'OPMEXT', 'OPMINT', 'ORDNR', 'PERCKORT',
            'PERCKORTGEWIJZ', 'PERCKORTKORT', 'PERCKORTKORTWIJZ', 'PRS', 'PRSGEWIJZ', 'PRSINCL',
            'RG', 'VAL', 'VERKOPER', 'VOLUME',

            //            'RAYON',
            //            'SAMENRG',
            //            'STATUS',
        ];
    }

    public function filters(): array
    {
        return [
            'ORDNR',
        ];
    }

    public function sorts(): array
    {
        return [
            'ORDNR',
        ];
    }

    public function unique(): string
    {
        return 'ORDNR';
    }

    public static function schema(): array
    {
        return [
            'aant' => ['float', 'AANT'],
            'aantbackord' => ['float', 'AANTBACKORD'],
            'aantgefact' => ['float', 'AANTGEFACT'],
            'aantgelev' => ['float', 'AANTGELEV'],
            'aantpickbon' => ['float', 'AANTPICKBON'],
            'aanttefact' => ['float', 'AANTTEFACT'],
            'aanttelev' => ['float', 'AANTTELEV'],
            'afdrfact' => ['string', 'AFDRFACT'],
            'afdrordbev' => ['string', 'AFDRORDBEV'],
            'afdrpick' => ['string', 'AFDRPICK'],
            'afdrverz' => ['string', 'AFDRVERZ'],
            'art' => ['string', 'ART'],
            'artgrp' => ['int', 'ARTGRP'],
            'bedr' => ['float', 'BEDR'],
            'bedrincl' => ['float', 'BEDRINCL'],
            'betaler' => ['int', 'BETALER'],
            'blok' => ['bool', 'BLOK'],
            'btwsrt' => ['string', 'BTWSRT'],
            'colli' => ['int', 'COLLI'],
            'dat' => ['string', 'DAT'],
            'datfact' => ['string', 'DATFACT'],
            'datlev' => ['string', 'DATLEV'],
            'datlevgewijz' => ['string', 'DATLEVGEWIJZ'],
            'datordbev' => ['string', 'DATORDBEV'],
            'deb' => ['int', 'DEB'],
            'eenh' => ['string', 'EENH'],
            'eenhprs' => ['int', 'EENHPRS'],
            'emballagerg' => ['int', 'EMBALLAGERG'],
            'extordnr' => ['int', 'EXTORDNR'],
            'fact' => ['int', 'FACT'],
            'gebrordbev' => ['string', 'GEBRORDBEV'],
            'inhoud' => ['int', 'INHOUD'],
            'istekstrg' => ['string', 'ISTEKSTRG'],
            'kdr' => ['int', 'KDR'],
            'kostpr' => ['float', 'KOSTPR'],
            'kpl' => ['int', 'KPL'],
            'levercorr' => ['string', 'LEVERCORR'],
            'mag' => ['int', 'MAG'],
            'omschr' => ['string', 'OMSCHR'],
            'opmext' => ['string', 'OPMEXT'],
            'opmint' => ['string', 'OPMINT'],
            'ordnr' => ['int', 'ORDNR'],
            'perckort' => ['float', 'PERCKORT'],
            'perckortgewijz' => ['string', 'PERCKORTGEWIJZ'],
            'perckortkort' => ['float', 'PERCKORTKORT'],
            'perckortkortwijz' => ['string', 'PERCKORTKORTWIJZ'],
            'prs' => ['float', 'PRS'],
            'prsgewijz' => ['string', 'PRSGEWIJZ'],
            'prsincl' => ['float', 'PRSINCL'],
            'rayon' => ['int', 'RAYON'],
            'rg' => ['int', 'RG'],
            'samenrg' => ['int', 'SAMENRG'],
            'status' => ['string', 'STATUS'],
            'val' => ['string', 'VAL'],
            'verkoper' => ['string', 'VERKOPER'],
            'volume' => ['float', 'VOLUME'],
        ];
    }
}
