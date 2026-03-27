<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\MedewerkerMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class MedewerkerAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return MedewerkerMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::MEDEWERKER->name;
    }

    public function fields(): array
    {
        return [
            'AANHEF', 'ACHTERNM', 'AFD', 'BLOK', 'BURGST', 'CRE', 'DATAFWTM', 'DATAFWVAN', 'DATEINDCONTR',
            'DATGEB', 'DATINDIENST', 'DATUITDIENST', 'EMAIL', 'GESLACHT', 'ISBUDH', 'ISDIRECTEUR',
            'ISEINDCONTR', 'ISEXT', 'ISINKOPER', 'ISVENNOOT', 'ISVERKOPER', 'KDR', 'KPL', 'MAG', 'MEDFN',
            'MEISJESNM', 'MOBIEL', 'OPM', 'ORDSRT', 'PERSNR', 'ROEPNM', 'TEL', 'TELPRIVE', 'TITEL',
            'TITELACHTER', 'TSNVGSL', 'VOORLTRS', 'ZKSL',
        ];
    }

    public function filters(): array
    {
        return [
            'ZKSL',
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
            'aanhef' => ['string', 'AANHEF'],
            'achternm' => ['string', 'ACHTERNM'],
            'afd' => ['string', 'AFD'],
            'blok' => ['bool', 'BLOK'],
            'burgst' => ['string', 'BURGST'],
            'cre' => ['int', 'CRE'],
            'datafwtm' => ['string', 'DATAFWTM'],
            'datafwvan' => ['string', 'DATAFWVAN'],
            'dateindcontr' => ['string', 'DATEINDCONTR'],
            'datgeb' => ['string', 'DATGEB'],
            'datindienst' => ['string', 'DATINDIENST'],
            'datuitdienst' => ['string', 'DATUITDIENST'],
            'email' => ['string', 'EMAIL'],
            'geslacht' => ['string', 'GESLACHT'],
            'isbudh' => ['bool', 'ISBUDH'],
            'isdirecteur' => ['bool', 'ISDIRECTEUR'],
            'iseindcontr' => ['string', 'ISEINDCONTR'],
            'isext' => ['bool', 'ISEXT'],
            'isinkoper' => ['bool', 'ISINKOPER'],
            'isvennoot' => ['string', 'ISVENNOOT'],
            'isverkoper' => ['bool', 'ISVERKOPER'],
            'kdr' => ['int', 'KDR'],
            'kpl' => ['int', 'KPL'],
            'mag' => ['int', 'MAG'],
            'medfn' => ['string', 'MEDFN'],
            'meisjesnm' => ['string', 'MEISJESNM'],
            'mobiel' => ['string', 'MOBIEL'],
            'opm' => ['string', 'OPM'],
            'ordsrt' => ['string', 'ORDSRT'],
            'persnr' => ['string', 'PERSNR'],
            'roepnm' => ['string', 'ROEPNM'],
            'tel' => ['string', 'TEL'],
            'telprive' => ['string', 'TELPRIVE'],
            'titel' => ['string', 'TITEL'],
            'titelachter' => ['string', 'TITELACHTER'],
            'tsnvgsl' => ['string', 'TSNVGSL'],
            'voorltrs' => ['string', 'VOORLTRS'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
