<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class LandDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?int $bankcdlen = null,
        public ?bool $blok = null,
        public ?bool $blokprofiel = null,
        public ?int $btwgeenexcldienst = null,
        public ?int $btwgeenexcllever = null,
        public ?int $btwgeenincldienst = null,
        public ?int $btwgeenincllever = null,
        public ?int $btwhoogexcldienst = null,
        public ?int $btwhoogexcllever = null,
        public ?int $btwhoogincldienst = null,
        public ?int $btwhoogincllever = null,
        public ?int $btwlaagexcldienst = null,
        public ?int $btwlaagexcllever = null,
        public ?int $btwlaagincldienst = null,
        public ?int $btwlaagincllever = null,
        public ?string $btwlandcd = null,
        public ?string $btwpl = null,
        public ?string $cbs = null,
        public ?string $hrow = null,
        public ?int $ibanlengte = null,
        public ?string $ibanstruct = null,
        public ?string $internationaal = null,
        public ?string $iso = null,
        public ?string $omschr = null,
        public ?string $sepa = null,
        public ?string $taal = null,
        public ?string $tel = null,
        public ?string $valuta = null,
        public ?string $zksl = null,
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
