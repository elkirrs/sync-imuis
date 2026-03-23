<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\CommandHandlers;

use App\Modules\Sync\Application\Commands\SyncTaskStatusCommand;
use App\Modules\Sync\Domain\Entities\SyncTaskDetailEntity;
use App\Modules\Sync\Domain\Repositories\SyncTaskDetailRepository;
use App\Modules\Sync\Domain\Repositories\SyncTaskRepository;
use App\Modules\Sync\Domain\ValueObject\DateTime;
use App\Modules\Sync\Domain\ValueObject\Details;
use App\Modules\Sync\Domain\ValueObject\Message;
use App\Modules\Sync\Domain\ValueObject\Status;
use App\Modules\Sync\Domain\ValueObject\UserId;
use App\Modules\Sync\Domain\ValueObject\UserType;
use App\Modules\Sync\Domain\ValueObject\Uuid;
use App\Modules\Sync\Enums\SyncTaskStatusEnum;
use DomainException;

final readonly class SyncTaskStatusCommandHandler
{
    public function __construct(
        private SyncTaskRepository $syncTaskRepository,
        private SyncTaskDetailRepository $syncTaskDetailsRepository
    ) {}

    public function __invoke(SyncTaskStatusCommand $command): void
    {
        $entitySyncTask = $this->syncTaskRepository->findOne($command->uuid);
        match ($command->status) {
            SyncTaskStatusEnum::Created->value => $entitySyncTask->created(),
            SyncTaskStatusEnum::Waiting->value => $entitySyncTask->waiting(),
            SyncTaskStatusEnum::Started->value => $entitySyncTask->start(),
            SyncTaskStatusEnum::Processing->value => $entitySyncTask->processing(),
            SyncTaskStatusEnum::Finished->value => $entitySyncTask->finished(),
            SyncTaskStatusEnum::Failed->value => $entitySyncTask->failed(),
            SyncTaskStatusEnum::Duplicate->value => $entitySyncTask->duplicate(),
            default => throw new DomainException('Unknown status')
        };

        $this->syncTaskRepository->save($entitySyncTask);

        if ($command->reason !== null) {
            $entitySyncTaskDetails = new SyncTaskDetailEntity(
                uuid: Uuid::generate(),
                syncUuid: new Uuid($entitySyncTask->uuid->value),
                userId: new UserId(0),
                userType: new UserType(0),
                message: new Message($command->reason->msg),
                status: new Status($command->reason->status),
                details: new Details($command->reason->details),
                createdAt: new DateTime(date('Y-m-d H:i:s')),
            );

            $this->syncTaskDetailsRepository->save($entitySyncTaskDetails);
        }
    }
}
