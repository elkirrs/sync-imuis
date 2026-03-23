<?php

declare(strict_types=1);

namespace App\Modules\Connection\Interfaces\Http;

use App\Helpers\Helper;
use App\Http\Requests\Web\Connection\CheckRequest;
use App\Modules\Connection\Application\Queries\ConnectionCheckQuery;
use App\Shared\Infrastructure\Bus\QueryBus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

final readonly class ConnectionCheckCommand
{
    public function __construct(
        protected QueryBus $queryBus
    ) {}

    public function __invoke(
        CheckRequest $request
    ): RedirectResponse {

        try {
            $data = $request->all();

            $query = new ConnectionCheckQuery(
                clientName: 'imuis',
                partnerKey: $data['partner_key'],
                authCode: $data['auth_code'],
                administrationCode: $data['administration_code'],
                url: $data['url']
            );

            $result = $this->queryBus->ask($query);

            if (! $result) {
                throw new \Exception('Connection check failed');
            }

            $status = 'success';
            $msg = 'Connection check successful';

        } catch (Throwable $th) {
            Log::error('ConnectionCheckCommand', Helper::LogErrorData($th));
            $status = 'error';
            $msg = __('Connection failed !');
        }

        return back()
            ->with('status', $status)
            ->with('msg', $msg);
    }
}
