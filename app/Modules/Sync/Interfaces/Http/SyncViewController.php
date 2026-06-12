<?php

declare(strict_types=1);

namespace App\Modules\Sync\Interfaces\Http;

use App\Modules\Sync\Application\Queries\SyncTaskDetailQuery;
use App\Modules\Sync\Application\Queries\SyncTaskQuery;
use App\Shared\Infrastructure\Bus\QueryBus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\View as ViewAlias;

final readonly class SyncViewController
{
    public function __construct(
        protected QueryBus $queryBus
    ) {}

    public function __invoke(
        string $uuid
    ): Factory|View|ViewAlias {

        $query = new SyncTaskDetailQuery($uuid);
        $detail = $this->queryBus->ask($query);

        $queryConnect = new SyncTaskQuery($uuid);
        $connectData = $this->queryBus->ask($queryConnect);

        return view('sync.detail', compact('detail', 'connectData'));
    }
}
