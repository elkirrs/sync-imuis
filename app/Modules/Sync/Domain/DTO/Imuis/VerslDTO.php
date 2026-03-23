<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\DTO\Imuis;

use App\Shared\Infrastructure\DTO\BaseDTO;

final readonly class VerslDTO extends BaseDTO
{
    public string $hash;

    public function __construct(
        public ?int $connect_id,
        ?string $hash,
        public ?bool $aanhef = null,
        public ?string $apbl = null,
        public ?bool $blok = null,
        public ?bool $blokprofiel = null,
        public ?string $finposcd = null,
        public ?int $finposnr = null,
        public ?string $hrow = null,
        public ?string $kasstrcd = null,
        public ?int $kasstrnr = null,
        public ?string $nieuwepaggrond = null,
        public ?string $nieuwepagina = null,
        public ?string $nieuwpagapbl = null,
        public ?string $nieuwpagresult = null,
        public ?int $nivo = null,
        public ?int $nr = null,
        public ?string $omschr = null,
        public ?string $onverdichtpubl = null,
        public ?string $opapbl = null,
        public ?string $opresultaat = null,
        public ?string $optoelichting = null,
        public ?string $optoelpublicatie = null,
        public ?string $selcd = null,
        public ?string $toelverdicht = null,
        public ?int $volgnr = null,
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
