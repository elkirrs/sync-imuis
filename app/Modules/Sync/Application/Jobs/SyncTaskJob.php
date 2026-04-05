<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\Jobs;

use App\Helpers\Helper;
use App\Modules\Sync\Application\Commands\SyncCommand;
use App\Modules\Sync\Application\Commands\SyncTaskStatusCommand;
use App\Modules\Sync\Domain\DTO\ReasonDTO;
use App\Modules\Sync\Domain\DTO\SyncTaskDTO;
use App\Modules\Sync\Enums\SyncTaskStatusEnum;
use App\Shared\Infrastructure\Bus\CommandBus;
use App\Shared\Infrastructure\Database\TenantConnectionManager;
use App\Shared\Infrastructure\Persistence\CacheStorage;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class SyncTaskJob implements ShouldQueue
{
    use Queueable;

    public int $timeout = 14400;

    public int $tries = 3;

    private CacheStorage $cache;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public SyncTaskDTO $syncTaskDTO,
    ) {
        $this->cache = app(CacheStorage::class);
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle(
        CommandBus $commandBus,
        TenantConnectionManager $tenant,
    ): void {

        Log::info('SyncTaskJob', ['msg' => SyncTaskStatusEnum::Processing->toString()]);

        $clientId = $this->syncTaskDTO->options->administrationId;
        $table = strtolower($this->syncTaskDTO->options->dbName);
        $uuid = $this->syncTaskDTO->uuid;
        $lockKey = "lock:{$clientId}:{$table}";
        $isLock = $this->cache->acquire($lockKey, $uuid, $this->timeout);
        $resultKey = 'sync:result:'.$this->syncTaskDTO->uuid;

        $tenantDB = Helper::TenantName($clientId);
        $tenant->connect($tenantDB);

        if (! $isLock) {
            $runningUuid = $this->cache->getValue($lockKey);
            if ($runningUuid === $this->syncTaskDTO->uuid) {
                return;
            }
            $syncTaskCommand = new SyncTaskStatusCommand(
                $this->syncTaskDTO->uuid,
                SyncTaskStatusEnum::Duplicate->value,
                new ReasonDTO(
                    msg: 'Duplicate task is already running',
                    status: SyncTaskStatusEnum::Duplicate->value,
                    details: "Currently running UUID: {$runningUuid}"
                )
            );
            $commandBus->dispatch($syncTaskCommand);
            Log::info('SyncTaskJob', [
                'msg' => "Duplicate  for {$clientId}:{$table}, running UUID: {$runningUuid}",
                'status' => SyncTaskStatusEnum::Duplicate->toString(),
            ]);

            return;
        }

        $syncTaskCommand = new SyncTaskStatusCommand(
            $this->syncTaskDTO->uuid,
            SyncTaskStatusEnum::Processing->value,
        );
        $commandBus->dispatch($syncTaskCommand);

        try {

            $syncCommand = new SyncCommand(
                administrationId: $this->syncTaskDTO->options->administrationId,
                table: $this->syncTaskDTO->options->dbName,
                client: 'imuis',
                uuid: $this->syncTaskDTO->uuid
            );
            $commandBus->dispatch($syncCommand);

            Log::info('SyncTaskJob', ['msg' => SyncTaskStatusEnum::Finished->toString()]);

            $dataSync = $this->cache->getValue($resultKey);

            $syncTaskCommand = new SyncTaskStatusCommand(
                $this->syncTaskDTO->uuid,
                SyncTaskStatusEnum::Finished->value,
                new ReasonDTO(
                    msg: 'The process was finished successfully.',
                    status: SyncTaskStatusEnum::Finished->value,
                    details: $dataSync
                ),
            );
            $commandBus->dispatch($syncTaskCommand);

        } catch (Throwable $th) {
            Log::error('SyncTaskJob', Helper::LogErrorData($th));
            $this->cache->release($lockKey);
            $this->cache->release($resultKey);

            $syncTaskCommand = new SyncTaskStatusCommand(
                $this->syncTaskDTO->uuid,
                SyncTaskStatusEnum::Failed->value,
                new ReasonDTO(
                    msg: 'The process was been finished with errors.',
                    status: SyncTaskStatusEnum::Failed->value,
                    details: $th->getMessage()
                ),
            );
            $commandBus->dispatch($syncTaskCommand);

            throw new Exception($th->getMessage());
        } finally {
            $this->cache->release($lockKey);
            $this->cache->release($resultKey);
        }
    }
}
