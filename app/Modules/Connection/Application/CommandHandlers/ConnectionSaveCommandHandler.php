<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\CommandHandlers;

use App\Modules\Connection\Application\Commands\ConnectionSaveCommand;
use App\Modules\Connection\Application\Services\CreateTenantDataBaseService;
use App\Modules\Connection\Domain\Entities\ConnectionEntity;
use App\Modules\Connection\Domain\Repositories\ConnectionRepository;
use App\Modules\Connection\Domain\ValueObjects\Active;
use App\Modules\Connection\Domain\ValueObjects\AdministrationCode;
use App\Modules\Connection\Domain\ValueObjects\AuthCode;
use App\Modules\Connection\Domain\ValueObjects\CreatedDB;
use App\Modules\Connection\Domain\ValueObjects\Description;
use App\Modules\Connection\Domain\ValueObjects\Id;
use App\Modules\Connection\Domain\ValueObjects\Name;
use App\Modules\Connection\Domain\ValueObjects\Options;
use App\Modules\Connection\Domain\ValueObjects\PartnerKey;
use App\Modules\Connection\Domain\ValueObjects\Tables;
use App\Modules\Connection\Domain\ValueObjects\Type;
use App\Modules\Connection\Domain\ValueObjects\Url;

readonly class ConnectionSaveCommandHandler
{
    public function __construct(
        private ConnectionRepository $repo,
        private CreateTenantDataBaseService $dbService,
    ) {}

    public function __invoke(
        ConnectionSaveCommand $command
    ): void {

        $entity = new ConnectionEntity(
            id: new Id($command->id),
            name: new Name($command->name),
            type: new Type($command->type),
            description: new Description($command->description),
            options: new Options(
                administrationCode: new AdministrationCode($command->administrationCode),
                partnerKey: new PartnerKey($command->partnerKey),
                authCode: new AuthCode($command->authCode),
                url: new Url($command->url),
                tables: new Tables($command->tables),
            ),
            isActive: new Active($command->isActive),
            isCreatedDB: new CreatedDB(false)
        );

        if ($command->id !== 0) {
            $entityConnect = $this->repo->findOne($command->id);
            $entity->createdDB($entityConnect->isCreatedDB->value);
        }

        if (! $entity->isCreatedDB->value) {
            $this->dbService->createForConnection($entity);
            $entity->createdDB(true);
        }
        $entity->createdDB(true);
        $this->repo->save($entity);
    }
}
