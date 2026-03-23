<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\QueryHandlers;

use App\Modules\Connection\Application\Queries\ConnectionQuery;
use App\Modules\Connection\Domain\DTO\ConnectionDTO;
use App\Modules\Connection\Domain\Repositories\ConnectionRepository;
use App\Modules\Connection\Infrastructure\Mappers\ConnectionMapper;

readonly class ConnectionQueryHandler
{
    public function __construct(
        private ConnectionRepository $repo,
    ) {}

    public function __invoke(
        ConnectionQuery $query
    ): ConnectionDTO {

        $entity = $this->repo->findOne($query->id);

        return ConnectionMapper::toDTO($entity);
    }
}
