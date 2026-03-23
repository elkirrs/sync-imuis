<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class DagboekDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?bool $blok = null,
        public ?bool $blokcre = null,
        public ?bool $blokdeb = null,
        public ?bool $blokgrb = null,
        public ?bool $blokhandm = null,
        public ?bool $blokprofiel = null,
        public ?string $boekstuk = null,
        public ?float $eindsaldo = null,
        public ?string $fact = null,
        public ?string $gebrjrboekstuk = null,
        public ?string $gebrjrfact = null,
        public ?int $kdr = null,
        public ?int $kpl = null,
        public ?int $nr = null,
        public ?string $omschr = null,
        public ?string $omschrboekstuk = null,
        public ?string $omschrcre = null,
        public ?string $omschrcreaant = null,
        public ?string $omschrcreaant2 = null,
        public ?string $omschrcreaant3 = null,
        public ?string $omschrdeb = null,
        public ?string $omschrdebaant = null,
        public ?string $omschrdebaant2 = null,
        public ?string $omschrdebaant3 = null,
        public ?string $omschrfact = null,
        public ?string $rekvoork = null,
        public ?bool $saldouitgrb = null,
        public ?string $srt = null,
        public ?int $tegrek = null,
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
