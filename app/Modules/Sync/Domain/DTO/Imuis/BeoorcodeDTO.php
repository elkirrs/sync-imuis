<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class BeoorcodeDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?bool $blok = null,
        public ?bool $blokprofiel = null,
        public ?string $hrow = null,
        public ?string $omschr = null,
        public ?string $prg = null,
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
