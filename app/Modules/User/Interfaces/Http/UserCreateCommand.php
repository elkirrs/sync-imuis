<?php

declare(strict_types=1);

namespace App\Modules\User\Interfaces\Http;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\View as ViewAlias;

final readonly class UserCreateCommand
{
    public function __invoke(): Factory|View|ViewAlias
    {
        return view('user.create');
    }
}
