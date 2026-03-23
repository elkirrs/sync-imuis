<?php

declare(strict_types=1);

namespace app\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class BetcondDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public int $connect_id,
        ?string $hash,
        public ?float $bedrordkst,        // MONEY
        public ?float $bedrordkstincl,    // MONEY
        public ?float $bedrordkstmax,     // MONEY
        public ?float $bedrordkstmaxinc,  // MONEY
        public ?string $betcode,          // string(1)
        public ?bool $blok,               // BOOLEAN
        public ?string $gebrvoor,         // string(1)
        public ?int $grbordkst,           // NUMERIC(8)
        public ?int $grbordkstink,        // NUMERIC(8)
        public ?bool $incasso,            // BOOLEAN
        public int $nr,                          // NUMERIC(3), PK, verplicht
        public ?string $opm,              // string(250)
        public ?float $percbetkort,       // NUMERIC(6)
        public ?float $perckb,            // NUMERIC(6)
        public ?int $vervdgn,             // NUMERIC(3)
        public ?string $zksl                      // string(40), verplicht
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
