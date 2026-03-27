<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\KdrMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class KdrAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return KdrMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::KDR->name;
    }

    public function fields(): array
    {
        return [
            'BLOK', 'DATAANVANG', 'DATGEREED', 'DEB', 'KDRUBLINL', 'MEDEWDEC', 'NIVO', 'NR', 'OMSCHR', 'OPM',
            'SELCD', 'VRIJVELD1', 'VRIJVELD2', 'VRIJVELD3', 'VRIJVELD4', 'VRIJVELD5', 'ZKSL',
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
            'blok' => ['bool', 'BLOK'],
            'dataanvang' => ['string', 'DATAANVANG'],
            'datgereed' => ['string', 'DATGEREED'],
            'deb' => ['int', 'DEB'],
            'kdrublinl' => ['string', 'KDRUBLINL'],
            'medewdec' => ['string', 'MEDEWDEC'],
            'nivo' => ['int', 'NIVO'],
            'nr' => ['int', 'NR'],
            'omschr' => ['string', 'OMSCHR'],
            'opm' => ['string', 'OPM'],
            'selcd' => ['string', 'SELCD'],
            'vrijveld1' => ['string', 'VRIJVELD1'],
            'vrijveld2' => ['string', 'VRIJVELD2'],
            'vrijveld3' => ['string', 'VRIJVELD3'],
            'vrijveld4' => ['string', 'VRIJVELD4'],
            'vrijveld5' => ['string', 'VRIJVELD5'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
