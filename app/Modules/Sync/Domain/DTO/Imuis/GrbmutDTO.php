<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class GrbmutDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?int $aant = null,
        public ?int $aant2 = null,
        public ?int $aant3 = null,
        public ?string $afgeletterd = null,
        public ?string $aflcd = null,
        public ?float $bedr = null,
        public ?float $bedrval = null,
        public ?string $boekstuk = null,
        public ?int $cre = null,
        public ?int $dagb = null,
        public ?string $dat = null,
        public ?int $deb = null,
        public ?string $debcre = null,
        public ?string $dossier = null,
        public ?int $fact = null,
        public ?int $grb = null,
        public ?int $jr = null,
        public ?string $jraansl = null,
        public ?int $kdr = null,
        public ?int $kpl = null,
        public ?int $pn = null,
        public ?int $rg = null,
        public ?string $srt = null,
        public ?int $tegrek = null,
        public ?int $transrow = null,
        public ?string $val = null,
    ) {
        if ($hash === null) {
            $data = $this->toArray();
            unset($data['jr']);
            ksort($data);
            $this->hash = md5(json_encode($data));
        } else {
            $this->hash = $hash;
        }
    }
}
