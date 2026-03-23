<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\LandMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class LandAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return LandMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::LAND->name;
    }

    public function fields(): array
    {
        return [
            'BANKCDLEN', 'BLOK', 'BLOKPROFIEL', 'BTWGEENEXCLDIENST', 'BTWGEENEXCLLEVER', 'BTWGEENINCLDIENST',
            'BTWGEENINCLLEVER', 'BTWHOOGEXCLDIENST', 'BTWHOOGEXCLLEVER', 'BTWHOOGINCLDIENST', 'BTWHOOGINCLLEVER',
            'BTWLAAGEXCLDIENST', 'BTWLAAGEXCLLEVER', 'BTWLAAGINCLDIENST', 'BTWLAAGINCLLEVER', 'BTWLANDCD', 'BTWPL',
            'CBS', 'HROW', 'IBANLENGTE', 'IBANSTRUCT', 'INTERNATIONAAL', 'ISO', 'OMSCHR', 'SEPA', 'TAAL', 'TEL',
            'VALUTA', 'ZKSL',
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

    public function unique(): string
    {
        return 'ZKSL';
    }

    public static function schema(): array
    {
        return [
            'bankcdlen' => ['int', 'BANKCDLEN'],
            'blok' => ['bool', 'BLOK'],
            'blokprofiel' => ['bool', 'BLOKPROFIEL'],
            'btwgeenexcldienst' => ['int', 'BTWGEENEXCLDIENST'],
            'btwgeenexcllever' => ['int', 'BTWGEENEXCLLEVER'],
            'btwgeenincldienst' => ['int', 'BTWGEENINCLDIENST'],
            'btwgeenincllever' => ['int', 'BTWGEENINCLLEVER'],
            'btwhoogexcldienst' => ['int', 'BTWHOOGEXCLDIENST'],
            'btwhoogexcllever' => ['int', 'BTWHOOGEXCLLEVER'],
            'btwhoogincldienst' => ['int', 'BTWHOOGINCLDIENST'],
            'btwhoogincllever' => ['int', 'BTWHOOGINCLLEVER'],
            'btwlaagexcldienst' => ['int', 'BTWLAAGEXCLDIENST'],
            'btwlaagexcllever' => ['int', 'BTWLAAGEXCLLEVER'],
            'btwlaagincldienst' => ['int', 'BTWLAAGINCLDIENST'],
            'btwlaagincllever' => ['int', 'BTWLAAGINCLLEVER'],
            'btwlandcd' => ['string', 'BTWLANDCD'],
            'btwpl' => ['string', 'BTWPL'],
            'cbs' => ['string', 'CBS'],
            'hrow' => ['string', 'HROW'],
            'ibanlengte' => ['int', 'IBANLENGTE'],
            'ibanstruct' => ['string', 'IBANSTRUCT'],
            'internationaal' => ['string', 'INTERNATIONAAL'],
            'iso' => ['string', 'ISO'],
            'omschr' => ['string', 'OMSCHR'],
            'sepa' => ['string', 'SEPA'],
            'taal' => ['string', 'TAAL'],
            'tel' => ['string', 'TEL'],
            'valuta' => ['string', 'VALUTA'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
