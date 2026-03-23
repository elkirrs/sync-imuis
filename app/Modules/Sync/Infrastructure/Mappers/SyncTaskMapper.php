<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers;

use App\Models\Sync;
use App\Modules\Sync\Domain\DTO\OptionDTO;
use App\Modules\Sync\Domain\DTO\SyncTaskDTO;
use App\Modules\Sync\Domain\Entities\SyncTaskEntity;
use App\Modules\Sync\Domain\ValueObject\Attempts;
use App\Modules\Sync\Domain\ValueObject\DateTime;
use App\Modules\Sync\Domain\ValueObject\Name;
use App\Modules\Sync\Domain\ValueObject\Option;
use App\Modules\Sync\Domain\ValueObject\Status;
use App\Modules\Sync\Domain\ValueObject\Uuid;

final class SyncTaskMapper
{
    public static function toEntity(
        Sync $model
    ): SyncTaskEntity {
        return new SyncTaskEntity(
            uuid: new Uuid($model->uuid),
            name: new Name($model->name),
            status: new Status($model->status),
            options: Option::fromJson($model->option),
            attempts: new Attempts($model->attempts),
            availableAt: new DateTime($model->available_at),
            createdAt: new DateTime($model->created_at),
            finishedAt: new DateTime($model->finished_at),
        );
    }

    public static function toDTO(
        SyncTaskEntity $entity
    ): SyncTaskDTO {

        return new SyncTaskDTO(
            uuid: $entity->uuid->value,
            name: $entity->name->value,
            status: $entity->status->value,
            options: new OptionDTO(
                dbName: $entity->options->nameDB->value,
                administrationId: $entity->options->administrationId->value,
            ),
            attempts: $entity->attempts->value,
            availableAt: $entity->availableAt->value,
            createdAt: $entity->createdAt->value,
            finishedAt: $entity?->finishedAt?->value,
        );
    }

    public static function toPersistence(
        SyncTaskEntity $entity
    ): array {

        return [
            'uuid' => $entity->uuid->value,
            'name' => $entity->name->value,
            'status' => $entity->status->value,
            'option' => $entity->options->toJson(),
            'attempts' => $entity->attempts->value,
            'available_at' => $entity->availableAt->value,
            'created_at' => $entity->createdAt->value,
            'finished_at' => $entity?->finishedAt?->value,
        ];
    }
}
