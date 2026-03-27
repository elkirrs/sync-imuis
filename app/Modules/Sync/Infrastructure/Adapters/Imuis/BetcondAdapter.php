<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\BetcondMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class BetcondAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return BetcondMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::BETCOND->name;
    }

    public function fields(): array
    {
        return [
            'NR', 'ZKSL', 'BEDRORDKST', 'BEDRORDKSTINCL', 'BEDRORDKSTMAX',
            'BEDRORDKSTMAXINC', 'BETCODE', 'BLOK', 'GEBRVOOR', 'GRBORDKST',
            'GRBORDKSTINK', 'INCASSO', 'OPM', 'PERCBETKORT', 'PERCKB',
            'VERVDGN',
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
            'ZKSL',
        ];
    }

    public function unique(): array
    {
        return [
            'ZKSL',
        ];
    }

    public static function schema(): array
    {
        return [
            'bedrordkst' => ['float', 'BEDRORDKST'],
            'bedrordkstincl' => ['float', 'BEDRORDKSTINCL'],
            'bedrordkstmax' => ['float', 'BEDRORDKSTMAX'],
            'bedrordkstmaxinc' => ['float', 'BEDRORDKSTMAXINC'],
            'betcode' => ['string', 'BETCODE'],
            'blok' => ['bool', 'BLOK'],
            'gebrvoor' => ['string', 'GEBRVOOR'],
            'grbordkst' => ['int', 'GRBORDKST'],
            'grbordkstink' => ['int', 'GRBORDKSTINK'],
            'incasso' => ['bool', 'INCASSO'],
            'nr' => ['int', 'NR'],
            'opm' => ['string', 'OPM'],
            'percbetkort' => ['float', 'PERCBETKORT'],
            'perckb' => ['float', 'PERCKB'],
            'vervdgn' => ['int', 'VERVDGN'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
