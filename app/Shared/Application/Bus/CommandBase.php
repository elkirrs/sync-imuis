<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus;

use App\Shared\Domain\Bus\Command;

interface CommandBase
{
    public function dispatch(Command $command): void;
}
