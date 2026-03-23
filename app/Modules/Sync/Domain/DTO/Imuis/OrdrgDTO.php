<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class OrdrgDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?float $aant = null,
        public ?float $aantbackord = null,
        public ?float $aantgefact = null,
        public ?float $aantgelev = null,
        public ?float $aantpickbon = null,
        public ?float $aanttefact = null,
        public ?float $aanttelev = null,
        public ?string $afdrfact = null,
        public ?string $afdrordbev = null,
        public ?string $afdrpick = null,
        public ?string $afdrverz = null,
        public ?string $art = null,
        public ?int $artgrp = null,
        public ?float $bedr = null,
        public ?float $bedrincl = null,
        public ?int $betaler = null,
        public ?bool $blok = null,
        public ?string $btwsrt = null,
        public ?int $colli = null,
        public ?string $dat = null,
        public ?string $datfact = null,
        public ?string $datlev = null,
        public ?string $datlevgewijz = null,
        public ?string $datordbev = null,
        public ?int $deb = null,
        public ?string $eenh = null,
        public ?int $eenhprs = null,
        public ?int $emballagerg = null,
        public ?int $extordnr = null,
        public ?int $fact = null,
        public ?string $gebrordbev = null,
        public ?int $inhoud = null,
        public ?string $istekstrg = null,
        public ?int $kdr = null,
        public ?float $kostpr = null,
        public ?int $kpl = null,
        public ?string $levercorr = null,
        public ?int $mag = null,
        public ?string $omschr = null,
        public ?string $opmext = null,
        public ?string $opmint = null,
        public ?int $ordnr = null,
        public ?float $perckort = null,
        public ?string $perckortgewijz = null,
        public ?float $perckortkort = null,
        public ?string $perckortkortwijz = null,
        public ?float $prs = null,
        public ?string $prsgewijz = null,
        public ?float $prsincl = null,
        public ?int $rayon = null,
        public ?int $rg = null,
        public ?int $samenrg = null,
        public ?string $status = null,
        public ?string $val = null,
        public ?string $verkoper = null,
        public ?float $volume = null,
    ) {
        if ($hash === null) {
            $data = $this->toArray();
            unset($data['ordnr']);
            ksort($data);
            $this->hash = md5(json_encode($data));
        } else {
            $this->hash = $hash;
        }
    }
}
