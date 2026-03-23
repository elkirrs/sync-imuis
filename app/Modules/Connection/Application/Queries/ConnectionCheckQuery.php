
<?php

declare(strict_types=1);

namespace App\Modules\Connection\Application\Queries;

use App\Shared\Domain\Bus\Query;

readonly class ConnectionCheckQuery implements Query
{
    public function __construct(
        public string $clientName,
        public string $partnerKey,
        public string $authCode,
        public string $administrationCode,
        public string $url
    ) {}
}
