<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\ArtgrpMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class ArtgrpAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return ArtgrpMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::ARTGRP->name;
    }

    public function fields(): array
    {
        return [
            'BLOK',
            'GRBHERW',
            'GRBKOSTPR',
            'GRBNTOGF',
            'GRBOMZ',
            'GRBOMZBINEU',
            'GRBOMZBUIEU',
            'GRBPVS',
            'GRBRNTOGF',
            'GRBVRD',
            'NR',
            'OMSCHR',
            'ZKSL',
            'GRBDIVVRD',
            //            'GRBINKNVRDREG',
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

    public function unique(): string
    {
        return 'NR';
    }

    public static function schema(): array
    {
        return [
            'nr' => ['int', 'NR'],
            'blok' => ['bool', 'BLOK'],
            'grbdivvrd' => ['int', 'GRBDIVVRD'],
            'grbherw' => ['int', 'GRBHERW'],
            'grbinknvrdreg' => ['int', 'GRBINKNVRDREG'],
            'grbkostpr' => ['int', 'GRBKOSTPR'],
            'grbntogf' => ['int', 'GRBNTOGF'],
            'grbomz' => ['int', 'GRBOMZ'],
            'grbomzbineu' => ['int', 'GRBOMZBINEU'],
            'grbomzbuieu' => ['int', 'GRBOMZBUIEU'],
            'grbpvs' => ['int', 'GRBPVS'],
            'grbrntogf' => ['int', 'GRBRNTOGF'],
            'grbvrd' => ['int', 'GRBVRD'],
            'omschr' => ['string', 'OMSCHR'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
