<?php

declare(strict_types=1);

namespace App\Modules\User\Interfaces\Http;

use App\Modules\User\Application\Queries\UserQuery;
use App\Shared\Infrastructure\Bus\QueryBus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\View as ViewAlias;

final readonly class UserEditCommand
{
    public function __construct(
        protected QueryBus $queryBus
    ) {}

    public function __invoke(
        int $id
    ): Factory|View|ViewAlias {

        $model = $this->queryBus->ask(
            new UserQuery($id)
        );

        return view('user.edit', compact('model'));
    }
}
