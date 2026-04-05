<?php

declare(strict_types=1);

namespace App\Modules\Sync\Application\CommandHandlers;

use App\Modules\Connection\Domain\Entities\ConnectionEntity;
use App\Modules\Connection\Domain\Repositories\ConnectionReadRepository;
use App\Modules\Sync\Application\Commands\SyncCommand;
use App\Modules\Sync\Domain\Repositories\SyncRepository;
use App\Modules\Sync\Infrastructure\Contracts\TableAdapter;
use App\Modules\Sync\Infrastructure\Factories\TableAdaptorFactory;
use App\Shared\Enums\ImuisDataTableEnum;
use App\Shared\Infrastructure\Connections\IntegrationConnection;
use App\Shared\Infrastructure\Factories\ClientFactory;

final readonly class SyncCommandHandler
{
    public function __construct(
        private ClientFactory $clientFactory,
        private TableAdaptorFactory $tableAdaptorFactory,
        private SyncRepository $syncRepository,
        private ConnectionReadRepository $administrations,
    ) {}

    public function __invoke(
        SyncCommand $command
    ): void {

        $connect = $this->administrations->findOne($command->administrationId);

        $connection = new IntegrationConnection(
            $command->client,
            $connect->options->toArray()
        );

        $client = $this->clientFactory->make($connection);

        $adaptor = $this->tableAdaptorFactory->make($command->table, $client);

        $rows = (function () use ($client, $adaptor, $connect) {

            foreach ($client->fetch($adaptor->query()) as $apiRow) {

                $apiRow['connect_id'] = $connect->id->value;
                yield $adaptor->map($apiRow);

            }

        })();

        $this->syncRepository->setConnection('tenant');

        // new data will be able added two ways: throughMerge and throughUpsert
        $data = $this->throughUpsert(
            command: $command,
            rows: $rows,
            adaptor: $adaptor,
        );

        cache()->add('sync:result:'.$command->uuid, json_encode($data));

    }

    private function throughMerge(
        SyncCommand $command,
        ConnectionEntity $connect,
        iterable $rows,
        TableAdapter $adaptor

    ): array {
        $table = ImuisDataTableEnum::fromName($command->table)->value;
        $stagingTable = 'staging_'.$table;

        $this->syncRepository->delete($stagingTable, $connect->id->value);

        $this->syncRepository->bulkInsert($rows, $stagingTable);
        $columns = array_map('strtolower', $adaptor->query()->fields);
        $columns[] = 'connect_id';
        $columns[] = 'hash';

        $data = array_map('strtolower', $adaptor->unique())
                |> (fn ($x) => array_merge(['connect_id'], $x))
                |> (fn ($x) => $this->syncRepository->merge(
                    targetTable: $table,
                    stagingTable: $stagingTable,
                    keys: $x,
                    columns: $columns,
                    sourceIdColumn: 'connect_id',
                    sourceId: $connect->id->value,
                ));

        $this->syncRepository->delete($stagingTable, $connect->id->value);

        return $data;
    }

    private function throughUpsert(
        SyncCommand $command,
        iterable $rows,
        TableAdapter $adaptor
    ): array {
        $table = ImuisDataTableEnum::fromName($command->table)->value;

        $this->syncRepository->setConnection('tenant');

        array_map('strtolower', $adaptor->unique())
            |> (fn ($x) => array_merge(['connect_id'], $x))
            |> (fn ($x) => $this->syncRepository->bulkUpsert(
                rows: $rows,
                tableName: $table,
                uniqueBy: $x
            ));

        $countRows = $this->syncRepository->count($table);

        return [
            'table' => $command->table,
            'count' => $countRows,
        ];
    }
}
