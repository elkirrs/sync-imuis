<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\Mappers;

use App\Models\SyncDetail;
use App\Modules\Sync\Domain\DTO\SyncTaskDetailDTO;
use App\Modules\Sync\Domain\Entities\SyncTaskDetailEntity;
use App\Modules\Sync\Domain\ValueObject\DateTime;
use App\Modules\Sync\Domain\ValueObject\Details;
use App\Modules\Sync\Domain\ValueObject\Message;
use App\Modules\Sync\Domain\ValueObject\Status;
use App\Modules\Sync\Domain\ValueObject\UserId;
use App\Modules\Sync\Domain\ValueObject\UserType;
use App\Modules\Sync\Domain\ValueObject\Uuid;

final class SyncDetailMapper
{
    public static function toEntity(
        SyncDetail $model
    ): SyncTaskDetailEntity {
        return new SyncTaskDetailEntity(
            uuid: new Uuid($model->uuid),
            syncUuid: new Uuid($model->sync_uuid),
            userId: new UserId($model->user_id),
            userType: new UserType($model->user_type),
            message: new Message($model->message),
            status: new Status($model->status),
            details: new Details($model->details),
            createdAt: new DateTime($model->created_at)
        );
    }

    public static function toDTO(
        SyncTaskDetailEntity $entity
    ): SyncTaskDetailDTO {

        return new SyncTaskDetailDTO(
            uuid: $entity->uuid->value,
            syncUuid: $entity->syncUuid->value,
            userId: $entity->userId->value,
            userType: $entity->userType->value,
            message: $entity->message->value,
            status: $entity->status->value,
            details: $entity->details->value,
            createdAt: $entity->createdAt->value
        );
    }

    public static function toPersistence(
        SyncTaskDetailEntity $entity
    ): array {
        return [
            'uuid' => $entity->uuid->value,
            'sync_uuid' => $entity->syncUuid->value,
            'user_id' => $entity->userId->value,
            'user_type' => $entity->userType->value,
            'message' => $entity->message->value,
            'status' => $entity->status->value,
            'details' => $entity->details->value,
            'created_at' => $entity->createdAt->value,
        ];
    }
}
