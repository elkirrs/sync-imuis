<?php

declare(strict_types=1);

namespace app\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class BtwDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?int $nr,
        public string $zksl,
        public ?string $blok,
        public ?string $blokcre,
        public ?string $blokdeb,
        public ?bool $blokprofiel,
        public string $btwber,
        public ?string $btwict,
        public ?string $btwpl,
        public ?string $datingang,
        public string $formgrp,
        public ?int $grb = null,
        public ?bool $loonwerk = null,
        public ?string $omschr = null,
        public ?string $opm = null,
        public ?float $perc = null,
        public ?float $percnw = null,
        public ?string $selcd = null,
        public ?bool $waarschcre = null,
        public ?bool $waarschdeb = null,
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
