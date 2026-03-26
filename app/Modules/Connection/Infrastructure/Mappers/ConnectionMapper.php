<?php

declare(strict_types=1);

namespace App\Modules\Connection\Infrastructure\Mappers;

use App\Models\Connection;
use App\Modules\Connection\Domain\DTO\ConnectionDTO;
use App\Modules\Connection\Domain\DTO\OptionsDTO;
use App\Modules\Connection\Domain\Entities\ConnectionEntity;
use App\Modules\Connection\Domain\ValueObjects\Active;
use App\Modules\Connection\Domain\ValueObjects\CreatedDB;
use App\Modules\Connection\Domain\ValueObjects\Description;
use App\Modules\Connection\Domain\ValueObjects\Id;
use App\Modules\Connection\Domain\ValueObjects\Name;
use App\Modules\Connection\Domain\ValueObjects\Options;
use App\Modules\Connection\Domain\ValueObjects\Type;

final class ConnectionMapper
{
    public static function toEntity(
        Connection $model
    ): ConnectionEntity {
        return new ConnectionEntity(
            new Id($model->id),
            new Name($model->name),
            new Type($model->type),
            new Description($model->description),
            Options::fromJson($model->options),
            new Active((bool) $model->is_active),
            new CreatedDB((bool) $model->is_created_db)
        );
    }

    public static function toDTO(
        ConnectionEntity $entity
    ): ConnectionDTO {

        return new ConnectionDTO(
            id: $entity->id->value,
            name: $entity->name->value,
            type: $entity->type->value,
            description: $entity->description->value,
            options: new OptionsDTO(
                administrationCode: $entity->options?->administrationCode?->value,
                partnerKey: $entity->options?->partnerKey?->value,
                authCode: $entity->options?->authCode?->value,
                url: $entity->options?->url?->value,
                tables: $entity->options?->tables?->value,
            ),
            isActive: $entity->isActive->value,
            isCreatedDB: $entity->isCreatedDB->value,
        );
    }

    public static function toPersistence(
        ConnectionEntity $entity
    ): array {
        return [
            'id' => $entity->id->value,
            'name' => $entity->name->value,
            'type' => $entity->type->value,
            'description' => $entity->description->value,
            'options' => $entity->options->toJson(),
            'is_active' => $entity->isActive->value,
            'is_created_db' => $entity->isCreatedDB->value,
        ];
    }
}
