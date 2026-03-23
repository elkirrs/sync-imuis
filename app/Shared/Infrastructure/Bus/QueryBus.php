<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Bus\QueryBase;
use App\Shared\Domain\Bus\Query;
use Illuminate\Contracts\Container\Container;

readonly class QueryBus implements QueryBase
{
    public function __construct(
        private Container $container
    ) {}

    public function ask(Query $query): mixed
    {
        $handlerClass = $this->resolveHandler($query);

        $handler = $this->container->make($handlerClass);

        return $handler($query);
    }

    private function resolveHandler(Query $query): string
    {
        return str_replace(
            'Queries',
            'QueryHandlers',
            get_class($query)
        ).'Handler';
    }
}
