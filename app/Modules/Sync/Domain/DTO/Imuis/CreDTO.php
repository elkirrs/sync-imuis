<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class CreDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?string $aanhef,
        public ?string $adres,
        public ?string $adressering,
        public int $betcond,
        public ?string $betkenmverpl,
        public ?string $betselafdruk,
        public bool $blok,
        public ?string $blokinkva,
        public ?string $bnkbnkrek,
        public ?string $bnkgrek,
        public ?string $bnkgiro,
        public ?string $bnkiban,
        public ?string $bnkrek,
        public ?int $bnkreknum,
        public ?string $bnksrtbet,
        public ?string $btwnr,
        public string $btwpl,
        public ?string $btwstatnaam = null,
        public ?string $certsleutel = null,
        public ?int $dagbink = null,
        public ?string $dataangem = null,
        public ?string $datbtwnr = null,
        public ?string $datkrlimtm = null,
        public ?string $datkrlimvan = null,
        public ?string $datkvkuittr = null,
        public ?string $datlstbet = null,
        public ?string $datlstfact = null,
        public ?int $deb = null,
        public ?string $econnectid = null,
        public ?string $email = null,
        public ?string $emailmailingjn = null,
        public ?string $fax = null,
        public ?float $franco = null,
        public ?string $giro = null,
        public ?string $giroiban = null,
        public ?string $gironaam = null,
        public ?int $gironum = null,
        public ?string $gpscoordb = null,
        public ?string $gpscoordl = null,
        public ?string $grek = null,
        public ?string $grekiban = null,
        public ?string $greknaam = null,
        public ?bool $heeftsaldo = null,
        public ?int $hnr = null,
        public ?string $hnrtv = null,
        public ?string $homepage = null,
        public ?string $inkoper = null,
        public ?int $kdr = null,
        public ?int $kpl = null,
        public ?float $krlim = null,
        public ?string $kvknr = null,
        public ?string $kvkplaats = null,
        public ?string $kvkstatnaam = null,
        public ?string $land = null,
        public ?string $levcond = null,
        public ?string $levsrt = null,
        public ?int $levtijd = null,
        public ?string $medew = null,
        public ?string $medewfiatbet = null,
        public ?string $medewfiatinkoop = null,
        public ?string $mobiel = null,
        public ?string $naam = null,
        public ?string $naam2 = null,
        public ?string $naamubl = null,
        public ?int $nr = null,
        public ?string $nrbijcre = null,
        public ?string $oin = null,
        public ?string $opdrwz = null,
        public ?string $opm = null,
        public ?string $opmint = null,
        public ?string $ordbevafdruk = null,
        public ?string $plaats = null,
        public ?string $postcd = null,
        public ?string $prslst = null,
        public ?string $rvorm = null,
        public ?float $saldo = null,
        public ?string $sjabloon = null,
        public ?int $sluitrek = null,
        public ?string $straat = null,
        public ?string $taal = null,
        public ?float $tebetalen = null,
        public ?int $tegrek = null,
        public ?string $tel = null,
        public ?string $telprive = null,
        public ?string $ubldoorboeken = null,
        public ?string $val = null,
        public ?string $verzwz = null,
        public ?string $vrijveld1 = null,
        public ?string $vrijveld2 = null,
        public ?string $zksl = null,
        public ?string $zkslext = null,
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
