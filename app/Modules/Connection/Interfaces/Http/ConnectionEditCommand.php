<?php

declare(strict_types=1);

namespace App\Modules\Connection\Interfaces\Http;

use App\Modules\Connection\Application\Queries\ConnectionQuery;
use App\Shared\Infrastructure\Bus\QueryBus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\View as ViewAlias;

final readonly class ConnectionEditCommand
{
    public function __construct(
        protected QueryBus $queryBus
    ) {}

    public function __invoke(
        int $id
    ): Factory|View|ViewAlias {
        $connection = $this->queryBus->ask(
            new ConnectionQuery($id)
        );

        return view('connection.edit', compact('connection'));
    }
}
