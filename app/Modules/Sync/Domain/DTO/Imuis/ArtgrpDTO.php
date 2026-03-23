<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class ArtgrpDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?int $nr = null,
        public ?bool $blok = null,
        public ?int $grbdivvrd = null,
        public ?int $grbherw = null,
        public ?int $grbinknvrdreg = null,
        public ?int $grbkostpr = null,
        public ?int $grbntogf = null,
        public ?int $grbomz = null,
        public ?int $grbomzbineu = null,
        public ?int $grbomzbuieu = null,
        public ?int $grbpvs = null,
        public ?int $grbrntogf = null,
        public ?int $grbvrd = null,
        public ?string $omschr = null,
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
