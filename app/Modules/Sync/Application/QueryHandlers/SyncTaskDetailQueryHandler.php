<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\QueryHandlers;

use App\Modules\Sync\Application\Queries\SyncTaskDetailQuery;
use App\Modules\Sync\Domain\Repositories\SyncTaskDetailRepository;
use App\Modules\Sync\Infrastructure\Mappers\SyncDetailMapper;

final class SyncTaskDetailQueryHandler
{
    public function __construct(
        protected SyncTaskDetailRepository $repository
    ) {}

    public function __invoke(
        SyncTaskDetailQuery $query
    ): array {

        $entities = $this->repository->findBy($query->syncTaskUuid, 'sync_uuid');

        $out = [];
        foreach ($entities as $entity) {
            $out[] = SyncDetailMapper::toDTO($entity);
        }

        return $out;
    }
}
