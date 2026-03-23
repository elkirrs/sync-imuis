<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class DossierDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?bool $blok = null,
        public ?bool $blokhandm = null,
        public ?bool $blokprofiel = null,
        public ?string $datbegin = null,
        public ?string $dateind = null,
        public ?int $kdr = null,
        public ?int $kpl = null,
        public ?string $locatie = null,
        public ?string $omschr = null,
        public ?string $opm = null,
        public ?string $wkroptie = null,
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
