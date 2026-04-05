<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class CreoppDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?string $aflgebr,
        public ?float $bedr,
        public ?float $bedrbkrttebetval,
        public ?float $bedrbtw,
        public ?float $bedrbtwval,
        public ?float $bedrgrek,
        public ?float $bedrkb,
        public ?float $bedrkbval,
        public ?float $bedroorsprval,
        public ?float $bedrtebet,
        public ?float $bedrval,
        public ?float $bet,
        public ?float $betgrek,
        public ?float $betval,
        public ?bool $betwist,
        public int $cre,
        public ?int $creditnotacre,
        public ?string $creditnotafact,
        public ?string $dat,
        public ?string $datlstbet,
        public ?string $datverv,
        public string $fact,
        public ?bool $fiat,
        public ?string $fiatinkoop,
        public ?bool $incasso,
        public ?int $kdr,
        public ?string $kenm,
        public ?string $kenmbatch,
        public ?int $kpl,
        public ?string $omschr,
        public ?string $opm,
        public ?float $saldo,
        public ?float $saldogrek,
        public ?float $saldooorsprval,
        public ?float $saldoval,
        public ?bool $voldaan
    ) {
        if ($hash === null) {
            $data = $this->toArray();
            unset($data['fact']);
            unset($data['cre']);
            ksort($data);
            $this->hash = md5(json_encode($data));
        } else {
            $this->hash = $hash;
        }
    }
}
