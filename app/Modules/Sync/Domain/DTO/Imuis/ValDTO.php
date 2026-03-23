<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class ValDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?string $zksl = null,
        public ?float $aantkoers = null,
        public ?int $afr = null,
        public ?bool $blok = null,
        public ?bool $blokprofiel = null,
        public ?int $herwkst = null,
        public ?int $herwopbr = null,
        public ?string $iso = null,
        public ?int $jrverv = null,
        public ?float $koers = null,
        public ?float $koersdefval = null,
        public ?int $krsverskst = null,
        public ?int $krsversopbr = null,
        public ?string $omschr = null,
        public ?string $teken = null,
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
