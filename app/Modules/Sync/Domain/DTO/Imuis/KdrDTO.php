<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class KdrDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?bool $blok = null,
        public ?string $dataanvang = null,
        public ?string $datgereed = null,
        public ?int $deb = null,
        public ?string $kdrublinl = null,
        public ?string $medewdec = null,
        public ?int $nivo = null,
        public ?int $nr = null,
        public ?string $omschr = null,
        public ?string $opm = null,
        public ?string $selcd = null,
        public ?string $vrijveld1 = null,
        public ?string $vrijveld2 = null,
        public ?string $vrijveld3 = null,
        public ?string $vrijveld4 = null,
        public ?string $vrijveld5 = null,
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
