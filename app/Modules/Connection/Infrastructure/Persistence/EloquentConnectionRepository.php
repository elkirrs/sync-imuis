<?php

declare(strict_types=1);

namespace App\Modules\Connection\Infrastructure\Persistence;

use App\Models\Connection;
use App\Modules\Connection\Domain\Entities\ConnectionEntity;
use App\Modules\Connection\Domain\Repositories\ConnectionReadRepository;
use App\Modules\Connection\Domain\Repositories\ConnectionRepository;
use App\Modules\Connection\Infrastructure\Mappers\ConnectionMapper;

class EloquentConnectionRepository implements ConnectionReadRepository, ConnectionRepository
{
    public function __construct(
        protected Connection $model
    ) {}

    public function save(ConnectionEntity &$entity): void
    {
        $out = $this->model->query()->updateOrCreate(
            ['id' => $entity->id->value],
            ConnectionMapper::toPersistence($entity)
        );

        if (empty($entity->id->value)) {
            $entity->setId($out?->id);
        }
    }

    public function findOne(int $int): ConnectionEntity
    {
        $model = $this->model->query()
            ->where('id', '=', $int)
            ->first();

        return ConnectionMapper::toEntity($model);
    }

    public function delete(ConnectionEntity $entity): void
    {
        $this->model->query()
            ->where('id', '=', $entity->id->value)
            ->delete();
    }

    public function findAllActive(): array
    {
        return $this->model->query()
            ->where('is_active', '=', true)
            ->get()
            ->map(fn ($model) => ConnectionMapper::toEntity($model))
            ->all();
    }

    public function findAll(): array
    {
        return $this->model->query()
            ->get()
            ->map(fn ($model) => ConnectionMapper::toEntity($model))
            ->all();
    }
}
