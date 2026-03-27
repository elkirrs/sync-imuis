<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Adapters\Imuis;

use App\Modules\Sync\Infrastructure\Adapters\AbstractAdapter;
use App\Modules\Sync\Infrastructure\Mappers\Imuis\DagboekMapper;
use App\Shared\Enums\ImuisDataTableEnum;

final class DagboekAdapter extends AbstractAdapter
{
    public function map(array $row): object
    {
        return DagboekMapper::fromApi($row, self::schema());
    }

    public function table(): string
    {
        return ImuisDataTableEnum::DAGBOEK->name;
    }

    public function fields(): array
    {
        return [
            'BLOK', 'BLOKCRE', 'BLOKDEB', 'BLOKGRB', 'BLOKHANDM', 'BLOKPROFIEL', 'BOEKSTUK', 'EINDSALDO',
            'FACT', 'GEBRJRBOEKSTUK', 'GEBRJRFACT', 'KDR', 'KPL', 'NR', 'OMSCHR', 'OMSCHRBOEKSTUK', 'OMSCHRCRE',
            'OMSCHRCREAANT', 'OMSCHRCREAANT2', 'OMSCHRCREAANT3', 'OMSCHRDEB', 'OMSCHRDEBAANT', 'OMSCHRDEBAANT2',
            'OMSCHRDEBAANT3', 'OMSCHRFACT', 'REKVOORK', 'SALDOUITGRB', 'SRT', 'TEGREK', 'ZKSL',
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
            'blokcre' => ['bool', 'BLOKCRE'],
            'blokdeb' => ['bool', 'BLOKDEB'],
            'blokgrb' => ['bool', 'BLOKGRB'],
            'blokhandm' => ['bool', 'BLOKHANDM'],
            'blokprofiel' => ['bool', 'BLOKPROFIEL'],
            'boekstuk' => ['string', 'BOEKSTUK'],
            'eindsaldo' => ['float', 'EINDSALDO'],
            'fact' => ['string', 'FACT'],
            'gebrjrboekstuk' => ['string', 'GEBRJRBOEKSTUK'],
            'gebrjrfact' => ['string', 'GEBRJRFACt'],
            'kdr' => ['int', 'KDR'],
            'kpl' => ['int', 'KPL'],
            'nr' => ['int', 'NR'],
            'omschr' => ['string', 'OMSCHR'],
            'omschrboekstuk' => ['string', 'OMSCHRBOEKSTUK'],
            'omschrcre' => ['string', 'OMSCHRCRE'],
            'omschrcreaant' => ['string', 'OMSCHRCREAANT'],
            'omschrcreaant2' => ['string', 'OMSCHRCREAANT2'],
            'omschrcreaant3' => ['string', 'OMSCHRCREAANT3'],
            'omschrdeb' => ['string', 'OMSCHRDEB'],
            'omschrdebaant' => ['string', 'OMSCHRDEBAANT'],
            'omschrdebaant2' => ['string', 'OMSCHRDEBAANT2'],
            'omschrdebaant3' => ['string', 'OMSCHRDEBAANT3'],
            'omschrfact' => ['string', 'OMSCHRFACT'],
            'rekvoork' => ['string', 'REKVOORK'],
            'saldouitgrb' => ['bool', 'SALDOUITGRB'],
            'srt' => ['string', 'SRT'],
            'tegrek' => ['int', 'TEGREK'],
            'zksl' => ['string', 'ZKSL'],
        ];
    }
}
