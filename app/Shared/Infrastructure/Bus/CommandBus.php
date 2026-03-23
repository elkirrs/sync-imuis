<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Bus\CommandBase;
use App\Shared\Domain\Bus\Command;
use Illuminate\Contracts\Container\Container;

readonly class CommandBus implements CommandBase
{
    public function __construct(
        private Container $container
    ) {}

    public function dispatch(Command $command): void
    {
        $handlerClass = $this->resolveHandler($command);

        $handler = $this->container->make($handlerClass);

        $handler($command);
    }

    private function resolveHandler(Command $command): string
    {
        return str_replace(
            'Commands',
            'CommandHandlers',
            get_class($command)
        ).'Handler';
    }
}
