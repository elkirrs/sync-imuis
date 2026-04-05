<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Factories;

use App\Modules\Sync\Infrastructure\Contracts\TableAdapter;
use App\Shared\Domain\Contracts\ExternalClient;
use App\Shared\Enums\ImuisDataTableEnum;
use InvalidArgumentException;

class TableAdaptorFactory
{
    public function make(
        string $table,
        ExternalClient $client
    ): TableAdapter {

        $table = ImuisDataTableEnum::fromName($table)->name;

        $clientName = $client->clientName();

        $adapterClass = sprintf(
            'App\\Modules\\Sync\\Infrastructure\\Adapters\\%s\\%sAdapter',
            ucfirst($clientName),
            ucfirst(strtolower($table)) // example, DEB => DebAdapter
        );

        if (! class_exists($adapterClass)) {
            throw new InvalidArgumentException("Adapter class {$adapterClass} does not exist");
        }

        return new $adapterClass;
    }
}
