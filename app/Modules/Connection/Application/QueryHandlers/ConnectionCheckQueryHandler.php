

<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\QueryHandlers;

use App\Modules\Connection\Application\Queries\ConnectionCheckQuery;
use App\Modules\Connection\Domain\DTO\ConnectionDTO;
use App\Shared\Infrastructure\Connections\IntegrationConnection;
use App\Shared\Infrastructure\Factories\ClientFactory;

readonly class ConnectionCheckQueryHandler
{
    public function __construct(
        private ClientFactory $clientFactory,
    ) {}

    public function __invoke(
        ConnectionCheckQuery $query
    ): ConnectionDTO {

        $options = [
            'partner_key' => $query->partnerKey,
            'auth_code' => $query->authCode,
            'url' => $query->url,
        ];
        $connection = new IntegrationConnection(
            $query->clientName,
            $options
        );

        $client = $this->clientFactory->make($connection);

        return $client->isConnected();

    }
}
