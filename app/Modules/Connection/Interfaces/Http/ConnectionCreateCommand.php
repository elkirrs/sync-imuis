<?php

declare(strict_types=1);

namespace App\Modules\Connection\Interfaces\Http;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\View as ViewAlias;

final readonly class ConnectionCreateCommand
{
    public function __invoke(): Factory|View|ViewAlias
    {
        return view('connection.create');
    }
}
