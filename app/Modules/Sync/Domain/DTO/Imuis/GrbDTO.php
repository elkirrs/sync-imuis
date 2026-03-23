<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class GrbDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?bool $aantadm = null,
        public ?string $act = null,
        public ?int $actnr = null,
        public ?string $acttype = null,
        public ?float $actvanaf = null,
        public ?string $afschrmeth = null,
        public ?string $apbl = null,
        public ?string $beoorcd = null,
        public ?bool $blok = null,
        public ?int $btw = null,
        public ?string $dc = null,
        public ?string $dossier = null,
        public ?bool $dossverpl = null,
        public ?int $grbafschrbalans = null,
        public ?int $grbafschrbalcum = null,
        public ?int $grbafschrvw = null,
        public ?int $grbdesinv = null,
        public ?int $grbdesinvafs = null,
        public ?int $grbdesinvverlies = null,
        public ?int $grbdesinvwinst = null,
        public ?int $grbherinvres = null,
        public ?int $grbopbrdesinv = null,
        public ?bool $herw = null,
        public ?string $isafl = null,
        public ?string $isaflrapportage = null,
        public ?string $isprive = null,
        public ?string $isrc = null,
        public ?int $kdr = null,
        public ?string $kdrverpl = null,
        public ?int $kpl = null,
        public ?string $kplverpl = null,
        public ?int $looptijd = null,
        public ?string $mapping = null,
        public ?int $nivo = null,
        public ?int $nr = null,
        public ?string $omschr = null,
        public ?string $opm = null,
        public ?int $rcadm = null,
        public ?int $rctegrek = null,
        public ?string $restgvherinv = null,
        public ?string $selcd = null,
        public ?string $rgs = null,
        public ?string $sluitrek = null,
        public ?string $specgrbmut = null,
        public ?string $specprive = null,
        public ?int $stamrechtgrbap = null,
        public ?int $stamrechtgrbbl = null,
        public ?string $stamrechtjn = null,
        public ?int $stamrechtjr = null,
        public ?int $stamrechtjr2 = null,
        public ?float $stamrechtperc = null,
        public ?int $stamrechtpn = null,
        public ?int $stamrechtpn2 = null,
        public ?string $stamrechtsoort = null,
        public ?string $stamrechtsoort2 = null,
        public ?string $term = null,
        public ?string $tonen = null,
        public ?string $transit = null,
        public ?string $val = null,
        public ?string $verdicht = null,
        public ?int $versl = null,
        public ?int $versl2 = null,
        public ?bool $vjp = null,
        public ?int $xbrl = null,
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
