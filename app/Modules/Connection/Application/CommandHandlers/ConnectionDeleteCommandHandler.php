<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\CommandHandlers;

use App\Modules\Connection\Application\Commands\ConnectionDeleteCommand;
use App\Modules\Connection\Domain\Entities\ConnectionEntity;
use App\Modules\Connection\Domain\Repositories\ConnectionRepository;
use App\Modules\Connection\Domain\ValueObjects\Id;

readonly class ConnectionDeleteCommandHandler
{
    public function __construct(
        private ConnectionRepository $repo,
    ) {}

    public function __invoke(
        ConnectionDeleteCommand $command
    ): void {

        $entity = new ConnectionEntity(
            id: new Id($command->id),
        );

        $this->repo->delete($entity);
    }
}
