<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\ArtMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class ArtAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return ArtMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::ART->value;
    }

    public function fields(): array
    {
        return [
            'AANTBINNEN', 'AANTCOLLI', 'AANTDOOS', 'ACTAFB', 'AFBEELDINGART', 'AFBEELDINGZKSL',
            'AFDRFACT', 'AFDROFFERTE', 'AFDRORDBEV', 'AFDRPICK', 'AFDRVERZ',
            'AFRAANT', 'AFRPRS', 'AFRPRSINCL', 'ARTGRP', 'ARTMLD', 'ARTSAMCODE',
            'BESTEL', 'BLOK', 'BLOKDECL', 'BLOKVRK', 'BLOKWEBSHOP', 'BREEDTEBRUTO', 'BREEDTEDOOS',
            'BREEDTENETTO', 'BTW', 'CAT', 'CATEGORIE', 'DATAANGEM', 'DIKTE', 'DOORSNEE',
            'EAN', 'EENHINK', 'EENHPRS', 'EENHVERK', 'EMBALLAGEART', 'EOL',
            'GEWICHTBRUTO', 'GEWICHTDOOS', 'GEWICHTNETTO', 'GIDSARTIKEL', 'HOOGTEBRUTO', 'HOOGTEDOOS', 'HOOGTENETTO',
            'INHVERK', 'INKPR', 'ISEMBALLAGE', 'ISTEKSTRG', 'KDR', 'KOSTPR',
            'KPL', 'LENGTEBRUTO', 'LENGTEDOOS', 'LENGTENETTO', 'LEVSRT', 'LEVTIJD', 'MAG', 'MINVERKOOP', 'NR',
            'OMSCHR', 'OPMEXT', 'OPMINT', 'SERIEGEBRHBDAT', 'SERIEINKSRT', 'SERIEINKTIJD', 'SERIEREGINK', 'SERIEREGVRK',
            'SERIEUNIEK', 'SERIEVERKSRT', 'SERIEVERKTIJD', 'VASTEPRS', 'VERKPR', 'VERPAKEENH',
            'VERPAKTPER', 'VOLUMEBRUTO', 'VOLUMEDOOS', 'VOLUMENETTO', 'VRDREG', 'VRIJVELD1',
            'VRIJVELD2', 'VRIJVELD3', 'VRIJVELD4', 'VRIJVELD5', 'VRIJVELD6', 'VRIJVELD7',
            'VRIJVELD8', 'VRIJVELD9', 'VRIJVELD10', 'ZKSL',
            //            'EENHINKPRS', 'KOSTPRHERW', 'KOSTPRHERWJN'

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
            'aantbinnen' => ['float', 'AANTBINNEN'],
            'aantcolli' => ['int', 'AANTCOLLI'],
            'aantdoos' => ['float', 'AANTDOOS'],
            'actafb' => ['string', 'ACTAFB'],
            'afbeeldingart' => ['string', 'AFBEELDINGART'],
            'afbeeldingzksl' => ['string', 'AFBEELDINGZKSL'],
            'afdrfact' => ['string', 'AFDRFACT'],
            'afdrofferte' => ['string', 'AFDROFFERTE'],
            'afdrordbev' => ['string', 'AFDRORDBEV'],
            'afdrpick' => ['string', 'AFDRPICK'],
            'afdrverz' => ['string', 'AFDRVERZ'],
            'afraant' => ['string', 'AFRAANT'],
            'afrprs' => ['string', 'AFRPRS'],
            'afrprsincl' => ['string', 'AFRPRSINCL'],
            'artgrp' => ['int', 'ARTGRP'],
            'artmld' => ['string', 'ARTMLD'],
            'artsamcode' => ['string', 'ARTSAMCODE'],
            'bestel' => ['string', 'BESTEL'],
            'blok' => ['bool', 'BLOK'],
            'blokdecl' => ['bool', 'BLOKDECL'],
            'blokvrk' => ['bool', 'BLOKVRK'],
            'blokwebshop' => ['bool', 'BLOKWEBSHOP'],
            'breedtebruto' => ['float', 'BREEDTEBRUTO'],
            'breedtedoos' => ['float', 'BREEDTEDOOS'],
            'breedtenetto' => ['float', 'BREEDTENETTO'],
            'btw' => ['string', 'BTW'],
            'cat' => ['string', 'CAT'],
            'categorie' => ['string', 'CATEGORIE'],
            'dataangem' => ['string', 'DATAANGEM'],
            'dikte' => ['float', 'DIKTE'],
            'doorsnee' => ['float', 'DOORSNEE'],
            'ean' => ['string', 'EAN'],
            'eenhink' => ['string', 'EENHINK'],
            'eenhinkprs' => ['int', 'EENHINKPRS'],
            'eenhprs' => ['int', 'EENHPRS'],
            'eenhverk' => ['string', 'EENHVERK'],
            'emballageart' => ['string', 'EMBALLAGEART'],
            'eol' => ['string', 'EOL'],
            'gewichtbruto' => ['float', 'GEWICHTBRUTO'],
            'gewichtdoos' => ['float', 'GEWICHTDOOS'],
            'gewichtnetto' => ['float', 'GEWICHTNETTO'],
            'gidsartikel' => ['string', 'GIDSARTIKEL'],
            'hoogtebruto' => ['float', 'HOOGTEBRUTO'],
            'hoogtedoos' => ['float', 'HOOGTEDOOS'],
            'hoogtenetto' => ['float', 'HOOGTENETTO'],
            'inhverk' => ['float', 'INHVERK'],
            'inkpr' => ['float', 'INKPR'],
            'isemballage' => ['string', 'ISEMBALLAGE'],
            'istekstrg' => ['string', 'ISTEKSTRG'],
            'kdr' => ['int', 'KDR'],
            'kostpr' => ['float', 'KOSTPR'],
            'kostprherw' => ['float', 'KOSTPRHERW'],
            'kostprherwjn' => ['string', 'KOSTPRHERWJN'],
            'kpl' => ['int', 'KPL'],
            'lengtebruto' => ['float', 'LENGTEBRUTO'],
            'lengtedoos' => ['float', 'LENGTEDOOS'],
            'lengtenetto' => ['float', 'LENGTENETTO'],
            'levsrt' => ['string', 'LEVSRT'],
            'levtijd' => ['int', 'LEVTijd'],
            'mag' => ['int', 'MAG'],
            'minverkoop' => ['float', 'MINVERKOOP'],
            'nr' => ['string', 'NR'],
            'omschr' => ['string', 'OMSCHR'],
            'opmext' => ['string', 'OPMEXT'],
            'opmint' => ['string', 'OPMINT'],
            'seriegebrhbdat' => ['string', 'SERIEGEBRHBdat'],
            'serieinksrt' => ['string', 'SERIEINKSRT'],
            'serieinktijd' => ['int', 'SERIEINKTIJD'],
            'serieregink' => ['string', 'SERIEREGINK'],
            'serieregvrk' => ['string', 'SERIEREGVRK'],
            'serieuniek' => ['string', 'SERIEUNIEK'],
            'serieverksrt' => ['string', 'SERIEVERKSRT'],
            'serieverktijd' => ['int', 'SERIEVERKTIJD'],
            'vasteprs' => ['bool', 'VASTEPRS'],
            'verkpr' => ['float', 'VERKPR'],
            'verkprincl' => ['float', 'VERKPRINCL'],
            'verpakeenh' => ['float', 'VERPAKEENH'],
            'verpaktper' => ['float', 'VERPAKTPER'],
            'volumebruto' => ['float', 'VOLUMEBRUTO'],
            'volumedoos' => ['float', 'VOLUMEDOOS'],
            'volumenetto' => ['float', 'VOLUMENETTO'],
            'vrdreg' => ['string', 'VRDREG'],
            'vrijveld1' => ['string', 'VRIJVELD1'],
            'vrijveld2' => ['string', 'VRIJVELD2'],
            'vrijveld3' => ['string', 'VRIJVELD3'],
            'vrijveld4' => ['string', 'VRIJVELD4'],
            'vrijveld5' => ['string', 'VRIJVELD5'],
            'vrijveld6' => ['string', 'VRIJVELD6'],
            'vrijveld7' => ['string', 'VRIJVELD7'],
            'vrijveld8' => ['string', 'VRIJVELD8'],
            'vrijveld9' => ['string', 'VRIJVELD9'],
            'vrijveld10' => ['string', 'VRIJVELD10'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
