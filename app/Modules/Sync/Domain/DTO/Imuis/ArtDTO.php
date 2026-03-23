<?php

declare(strict_types=1);

namespace app\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class ArtDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?float $aantbinnen = null,
        public ?int $aantcolli = null,
        public ?float $aantdoos = null,
        public ?string $actafb = null,
        public ?string $afbeeldingart = null,
        public ?string $afbeeldingzksl = null,
        public ?string $afdrfact = null,
        public ?string $afdrofferte = null,
        public ?string $afdrordbev = null,
        public ?string $afdrpick = null,
        public ?string $afdrverz = null,
        public ?string $afraant = null,
        public ?string $afrprs = null,
        public ?string $afrprsincl = null,
        public ?int $artgrp = null,
        public ?string $artmld = null,
        public ?string $artsamcode = null,
        public ?string $bestel = null,
        public ?bool $blok = null,
        public ?bool $blokdecl = null,
        public ?bool $blokvrk = null,
        public ?bool $blokwebshop = null,
        public ?float $breedtebruto = null,
        public ?float $breedtedoos = null,
        public ?float $breedtenetto = null,
        public ?string $btw = null,
        public ?string $cat = null,
        public ?string $categorie = null,
        public ?string $dataangem = null,
        public ?float $dikte = null,
        public ?float $doorsnee = null,
        public ?string $ean = null,
        public ?string $eenhink = null,
        public ?int $eenhinkprs = null,
        public ?int $eenhprs = null,
        public ?string $eenhverk = null,
        public ?string $emballageart = null,
        public ?string $eol = null,
        public ?float $gewichtbruto = null,
        public ?float $gewichtdoos = null,
        public ?float $gewichtnetto = null,
        public ?string $gidsartikel = null,
        public ?float $hoogtebruto = null,
        public ?float $hoogtedoos = null,
        public ?float $hoogtenetto = null,
        public ?float $inhverk = null,
        public ?float $inkpr = null,
        public ?string $isemballage = null,
        public ?string $istekstrg = null,
        public ?int $kdr = null,
        public ?float $kostpr = null,
        public ?float $kostprherw = null,
        public ?string $kostprherwjn = null,
        public ?int $kpl = null,
        public ?float $lengtebruto = null,
        public ?float $lengtedoos = null,
        public ?float $lengtenetto = null,
        public ?string $levsrt = null,
        public ?int $levtijd = null,
        public ?int $mag = null,
        public ?float $minverkoop = null,
        public ?string $nr = null,
        public ?string $omschr = null,
        public ?string $opmext = null,
        public ?string $opmint = null,
        public ?string $seriegebrhbdat = null,
        public ?string $serieinksrt = null,
        public ?int $serieinktijd = null,
        public ?string $serieregink = null,
        public ?string $serieregvrk = null,
        public ?string $serieuniek = null,
        public ?string $serieverksrt = null,
        public ?int $serieverktijd = null,
        public ?bool $vasteprs = null,
        public ?float $verkpr = null,
        public ?float $verkprincl = null,
        public ?float $verpakeenh = null,
        public ?float $verpaktper = null,
        public ?float $volumebruto = null,
        public ?float $volumedoos = null,
        public ?float $volumenetto = null,
        public ?string $vrdreg = null,
        public ?string $vrijveld1 = null,
        public ?string $vrijveld2 = null,
        public ?string $vrijveld3 = null,
        public ?string $vrijveld4 = null,
        public ?string $vrijveld5 = null,
        public ?string $vrijveld6 = null,
        public ?string $vrijveld7 = null,
        public ?string $vrijveld8 = null,
        public ?string $vrijveld9 = null,
        public ?string $vrijveld10 = null,
        public ?string $zksl = null,

    ) {
        if ($hash === null) {
            $data = $this->toArray();
            unset($data['nr']);
            ksort($data);
            $this->hash = md5(json_encode($data));
        } else {
            $this->hash = $hash;
        }
    }
}
