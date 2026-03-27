<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\SelcodeMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class SelcodeAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return SelcodeMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::SELCODE->name;
    }

    public function fields(): array
    {
        return ['BLOK', 'MAILINGLIST', 'OMSCHR', 'ZKSL'];
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
        return ['ZKSL'];
    }

    public static function schema(): array
    {
        return [
            'blok' => ['bool', 'BLOK'],
            'mailinglist' => ['string', 'MAILINGLIST'],
            'omschr' => ['string', 'OMSCHR'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
