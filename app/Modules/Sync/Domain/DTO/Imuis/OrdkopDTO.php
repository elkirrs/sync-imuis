<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class OrdkopDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?float $bedrbetkort = null,
        public ?float $bedrbetkortincl = null,
        public ?float $bedrbineu = null,
        public ?float $bedrbuieu = null,
        public ?float $bedrfact = null,
        public ?float $bedrgeen = null,
        public ?float $bedrgrek = null,
        public ?float $bedrhoog = null,
        public ?float $bedrinclbineu = null,
        public ?float $bedrinclbuieu = null,
        public ?float $bedrinclfact = null,
        public ?float $bedrinclgeen = null,
        public ?float $bedrinclhoog = null,
        public ?float $bedrincllaag = null,
        public ?float $bedrinclopen = null,
        public ?float $bedrincltot = null,
        public ?float $bedrinclverlegd = null,
        public ?float $bedrkb = null,
        public ?float $bedrkbincl = null,
        public ?float $bedrkostpr = null,
        public ?float $bedrlaag = null,
        public ?float $bedropen = null,
        public ?float $bedrordkst = null,
        public ?float $bedrordkstfactin = null,
        public ?float $bedrordkstgefact = null,
        public ?string $bedrordkstgewijz = null,
        public ?float $bedrordkstincl = null,
        public ?float $bedrtot = null,
        public ?float $bedrverlegd = null,
        public ?float $bedrvrachtkst = null,
        public ?string $bedrvrachtkstwz = null,
        public ?float $bedrvrkstfactinc = null,
        public ?float $bedrvrkstgefact = null,
        public ?float $bedrvrkstincl = null,
        public ?int $betaler = null,
        public ?string $betcode = null,
        public ?int $betcond = null,
        public ?bool $blok = null,
        public ?string $btwpl = null,
        public ?string $dat = null,
        public ?string $datlev = null,
        public ?string $datlevgewijz = null,
        public ?string $datlevuiterst = null,
        public ?string $datordbev = null,
        public ?string $datpick = null,
        public ?string $datvast = null,
        public ?string $datvrwrk = null,
        public ?int $deb = null,
        public ?int $extordnr = null,
        public ?string $gebrordbev = null,
        public ?string $gefact = null,
        public ?string $incasso = null,
        public ?string $isincl = null,
        public ?int $kdr = null,
        public ?string $kenm = null,
        public ?int $kpl = null,
        public ?string $levcond = null,
        public ?int $mag = null,
        public ?string $mdt = null,
        public ?string $medewvast = null,
        public ?int $nr = null,
        public ?int $nrrit = null,
        public ?string $opdrwz = null,
        public ?string $opm = null,
        public ?string $ordercompleet = null,
        public ?string $ordsrt = null,
        public ?float $percbetkort = null,
        public ?float $percgrek = null,
        public ?float $perckb = null,
        public ?float $percloon = null,
        public ?string $prslst = null,
        public ?int $rit = null,
        public ?string $selcd = null,
        public ?string $taal = null,
        public ?string $tefact = null,
        public ?string $val = null,
        public ?string $verkoper = null,
        public ?int $vervdgn = null,
        public ?string $verzadres = null,
        public ?string $verzadressering = null,
        public ?int $verzcntrel = null,
        public ?string $verzcntzksl = null,
        public ?int $verzdeb = null,
        public ?string $verzemail = null,
        public ?int $verzhnr = null,
        public ?string $verzhnrtv = null,
        public ?string $verzland = null,
        public ?string $verznaam = null,
        public ?string $verznaam2 = null,
        public ?string $verzplaats = null,
        public ?string $verzpostcd = null,
        public ?string $verzstraat = null,
        public ?string $verztel = null,
        public ?string $verzwz = null,
        public ?string $verzzksl = null,
        public ?float $volume = null,

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
