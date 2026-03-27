<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class MedewerkerDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?string $aanhef = null,
        public ?string $achternm = null,
        public ?string $afd = null,
        public ?bool $blok = null,
        public ?string $burgst = null,
        public ?int $cre = null,
        public ?string $datafwtm = null,
        public ?string $datafwvan = null,
        public ?string $dateindcontr = null,
        public ?string $datgeb = null,
        public ?string $datindienst = null,
        public ?string $datuitdienst = null,
        public ?string $email = null,
        public ?string $geslacht = null,
        public ?bool $isbudh = null,
        public ?bool $isdirecteur = null,
        public ?string $iseindcontr = null,
        public ?bool $isext = null,
        public ?bool $isinkoper = null,
        public ?string $isvennoot = null,
        public ?bool $isverkoper = null,
        public ?int $kdr = null,
        public ?int $kpl = null,
        public ?int $mag = null,
        public ?string $medfn = null,
        public ?string $meisjesnm = null,
        public ?string $mobiel = null,
        public ?string $opm = null,
        public ?string $ordsrt = null,
        public ?string $persnr = null,
        public ?string $roepnm = null,
        public ?string $tel = null,
        public ?string $telprive = null,
        public ?string $titel = null,
        public ?string $titelachter = null,
        public ?string $tsnvgsl = null,
        public ?string $voorltrs = null,
        public ?string $zksl = null
    ) {
        if ($hash === null) {
            $data = $this->toArray();
            unset($data['zksl']);
            ksort($data);
            $this->hash = md5(json_encode($data));
        } else {
            $this->hash = $hash;
        }
    }
}
