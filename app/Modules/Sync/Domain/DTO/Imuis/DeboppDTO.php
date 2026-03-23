<?php

declare(strict_types=1);

namespace app\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class DeboppDTO extends BaseDTO
{
    public ?string $hash;

    public function __construct(
        public int $connect_id,
        ?string $hash = null,
        public ?int $aanm = null,
        public ?int $aantinc = null,
        public ?float $bedr = null,
        public ?float $bedrbetkort = null,
        public ?float $bedrbetkortval = null,
        public ?float $bedrbetkrtteinc = null,
        public ?float $bedrbkrtteincval = null,
        public ?float $bedrbtw = null,
        public ?float $bedrbtwval = null,
        public ?float $bedrkb = null,
        public ?float $bedrkbval = null,
        public ?float $bedroorsprval = null,
        public ?float $bedrval = null,
        public ?float $bet = null,
        public ?int $betaler = null,
        public ?int $betcond = null,
        public ?int $betregdeb = null,
        public ?string $betregfact = null,
        public ?float $betval = null,
        public ?bool $betwist = null,
        public ?string $bnkrek = null,
        public ?int $creditnotadeb = null,
        public ?string $creditnotafact = null,
        public ?string $dat = null,
        public ?string $datlstaanm = null,
        public ?string $datlstbet = null,
        public ?string $datuitv = null,
        public ?string $datverv = null,
        public ?int $deb = null,
        public ?int $deborder = null,
        public ?string $fact = null,
        public ?int $kdr = null,
        public ?string $kenm = null,
        public ?int $kpl = null,
        public ?string $mdt = null,
        public ?string $omschr = null,
        public ?string $opm = null,
        public ?float $saldo = null,
        public ?float $saldooorsprval = null,
        public ?float $saldoval = null,
        public ?string $uithanden = null,
        public ?string $val = null,
        public ?bool $voldaan = null,
    ) {
        if ($hash === null) {
            $data = $this->toArray();
            unset($data['fact']);
            ksort($data);
            $this->hash = md5(json_encode($data));
        } else {
            $this->hash = $hash;
        }
    }
}
