<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class BoeDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?float $aant,
        public ?float $aant2,
        public ?float $aant3,
        public ?float $aantcre,
        public ?float $aantcre2,
        public ?float $aantcre3,
        public ?float $aantdeb,
        public ?float $aantdeb2,
        public ?float $aantdeb3,
        public ?float $bedr,
        public ?float $bedrbetkort,
        public ?float $bedrboek,
        public ?float $bedrboekval,
        public ?float $bedrbtw,
        public ?float $bedrcre,
        public ?float $bedrdeb,
        public ?float $bedrincl,
        public ?float $bedrkb,
        public ?float $bedrbtwval,
        public ?string $beoorcd,
        public ?string $boekstuk,
        public ?int $btw,
        public ?int $cre,
        public int $dagb,
        public string $dat,
        public ?int $deb,
        public ?string $dossier,
        public ?string $fact,
        public int $grb,
        public ?int $grprow,
        public ?bool $isopboek,
        public int $jr,
        public ?int $kdr,
        public ?float $koers,
        public ?int $kpl,
        public ?string $omschr,
        public ?string $opm,
        public int $pn,
        public ?string $prg,
        public ?int $rek,
        public int $rg,
        public ?bool $storno,
        public int $tegrek,
        public ?string $val = null,
    ) {
        if ($hash === null) {
            $data = $this->toArray();
            unset($data['jr']);
            unset($data['pn']);
            ksort($data);
            $this->hash = md5(json_encode($data));
        } else {
            $this->hash = $hash;
        }
    }
}
