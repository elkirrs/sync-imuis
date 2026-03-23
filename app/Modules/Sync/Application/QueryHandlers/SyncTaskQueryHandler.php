<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\QueryHandlers;

use App\Modules\Sync\Application\Queries\SyncTaskQuery;
use App\Modules\Sync\Domain\DTO\SyncTaskDTO;
use App\Modules\Sync\Domain\Repositories\SyncTaskRepository;
use App\Modules\Sync\Infrastructure\Mappers\SyncTaskMapper;

final class SyncTaskQueryHandler
{
    public function __construct(
        protected SyncTaskRepository $repository
    ) {}

    public function __invoke(SyncTaskQuery $query): SyncTaskDTO
    {
        $entity = $this->repository->findOne($query->uuid);

        return SyncTaskMapper::toDTO($entity);
    }
}
