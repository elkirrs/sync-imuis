<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\CommandHandlers;

use App\Modules\Sync\Application\Commands\SyncTaskScheduleCommand;
use App\Modules\Sync\Application\Jobs\SyncTaskJob;
use App\Modules\Sync\Domain\Repositories\SyncTaskRepository;
use App\Modules\Sync\Infrastructure\Mappers\SyncTaskMapper;
use Carbon\Carbon;

final readonly class SyncTaskScheduleCommandHandler
{
    public function __construct(
        private SyncTaskRepository $repository
    ) {}

    public function __invoke(SyncTaskScheduleCommand $command): void
    {
        $data = $this->repository->getSyncTask();

        foreach ($data as $task) {

            SyncTaskJob::dispatch(SyncTaskMapper::toDTO($task))
                ->delay(Carbon::parse($task->availableAt->value))
                ->onQueue('sync');

            $task->waiting();
            $this->repository->save($task);
        }
    }
}
