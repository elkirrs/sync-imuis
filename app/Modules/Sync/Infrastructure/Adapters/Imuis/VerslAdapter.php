<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\VerslkMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class VerslAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return VerslkMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::VERSL->name;
    }

    public function fields(): array
    {
        return [
            'AANHEF', 'APBL', 'BLOK', 'BLOKPROFIEL', 'FINPOSCD', 'FINPOSNR', 'HROW', 'KASSTRCD',
            'KASSTRNR', 'NIEUWEPAGGROND', 'NIEUWPAGAPBL', 'NIEUWPAGRESULT', 'NIVO',
            'NR', 'OMSCHR', 'ONVERDICHTPUBL', 'OPAPBL', 'OPRESULTAAT', 'OPTOELICHTING', 'OPTOELPUBLICATIE',
            'SELCD', 'TOELVERDICHT', 'VOLGNR', 'ZKSL', 'NIEUWEPAGINA',

        ];
    }

    public function filters(): array
    {
        return [
            'NR',
        ];
    }

    public function sorts(): array
    {
        return [
            'NR',
        ];
    }

    public function unique(): array
    {
        return ['NR'];
    }

    public static function schema(): array
    {
        return [
            'aanhef' => ['bool', 'AANHEF'],
            'apbl' => ['string', 'APBL'],
            'blok' => ['bool', 'BLOK'],
            'blokprofiel' => ['bool', 'BLOKPROFIEL'],
            'finposcd' => ['string', 'FINPOSCD'],
            'finposnr' => ['int', 'FINPOSNR'],
            'hrow' => ['string', 'HROW'],
            'kasstrcd' => ['string', 'KASSTRCD'],
            'kasstrnr' => ['int', 'KASSTRNR'],
            'nieuwepaggrond' => ['string', 'NIEUWEPAGGROND'],
            'nieuwepagina' => ['string', 'NIEUWEPAGINA'],
            'nieuwpagapbl' => ['string', 'NIEUWPAGAPBL'],
            'nieuwpagresult' => ['string', 'NIEUWPAGRESULT'],
            'nivo' => ['int', 'NIVO'],
            'nr' => ['int', 'NR'],
            'omschr' => ['string', 'OMSCHR'],
            'onverdichtpubl' => ['string', 'ONVERDICHTPUBL'],
            'opapbl' => ['string', 'OPAPBL'],
            'opresultaat' => ['string', 'OPRESULTAAT'],
            'optoelichting' => ['string', 'OPTOELICHTING'],
            'optoelpublicatie' => ['string', 'OPTOELPUBLICATIE'],
            'selcd' => ['string', 'SELCD'],
            'toelverdicht' => ['string', 'TOELVERDICHT'],
            'volgnr' => ['int', 'VOLGNR'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
