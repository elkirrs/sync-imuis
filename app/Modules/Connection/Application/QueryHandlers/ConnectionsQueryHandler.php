<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\QueryHandlers;

use App\Modules\Connection\Application\Queries\ConnectionsQuery;
use App\Modules\Connection\Domain\Repositories\ConnectionRepository;
use App\Modules\Connection\Infrastructure\Mappers\ConnectionMapper;

readonly class ConnectionsQueryHandler
{
    public function __construct(
        private ConnectionRepository $repo,
    ) {}

    public function __invoke(
        ConnectionsQuery $query
    ): array {

        $entities = $this->repo->findAll();

        $out = [];
        foreach ($entities as $entity) {

            $out[] = ConnectionMapper::toDTO($entity);
        }

        return $out;
    }
}
