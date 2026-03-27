<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\BtwMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class BtwAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return BtwMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::BTW->name;
    }

    public function fields(): array
    {
        return [
            'NR', 'ZKSL', 'BLOK', 'BLOKCRE', 'BLOKDEB', 'BLOKPROFIEL', 'BTWBER',
            'BTWICT', 'BTWPL', 'DATINGANG', 'FORMGRP', 'GRB', 'LOONWERK', 'OMSCHR',
            'OPM', 'PERC', 'PERCNW', 'SELCD', 'WAARSCHCRE', 'WAARSCHDEB',
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
            'nr' => ['int', 'NR'],
            'zksl' => ['string', 'ZKSL'],
            'blok' => ['string', 'BLOK'],
            'blokcre' => ['string', 'BLOKCRE'],
            'blokdeb' => ['string', 'BLOKDEB'],
            'blokprofiel' => ['bool', 'BLOKPROFIEL'],
            'btwber' => ['string', 'BTWBER'],
            'btwict' => ['string', 'BTWICT'],
            'btwpl' => ['string', 'BTWPL'],
            'datingang' => ['string', 'DATINGANG'],
            'formgrp' => ['string', 'FORMGRP'],
            'grb' => ['int', 'GRB'],
            'loonwerk' => ['bool', 'LOONWERK'],
            'omschr' => ['string', 'OMSCHR'],
            'opm' => ['string', 'OPM'],
            'perc' => ['float', 'PERC'],
            'percnw' => ['float', 'PERCNW'],
            'selcd' => ['string', 'SELCD'],
            'waarschcre' => ['bool', 'WAARSCHCRE'],
            'waarschdeb' => ['bool', 'WAARSCHDEB'],
        ];
    }
}
