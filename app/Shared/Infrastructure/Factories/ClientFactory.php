<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Factories;

use App\Shared\Domain\Contracts\ExternalClient;
use App\Shared\Infrastructure\Connections\IntegrationConnection;
use RuntimeException;

class ClientFactory
{
    public function __construct(
        private iterable $clients
    ) {}

    public function make(IntegrationConnection $connection): ExternalClient
    {
        foreach ($this->clients as $client) {
            if ($client->supports($connection->clientName)) {
                $client->connect($connection->credentials);

                return $client;
            }
        }

        throw new RuntimeException("External client '{$connection->clientName}' not found");
    }
}
