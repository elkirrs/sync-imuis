<?php

declare(strict_types=1);

namespace App\Modules\Connection\Infrastructure\ExternalClients;

use App\Modules\Sync\Domain\DTO\QueryDTO;
use App\Shared\Domain\Contracts\ExternalClient;
use App\Shared\Infrastructure\ExternalClient\AbstractExternalClient;

final class ImuisClient extends AbstractExternalClient implements ExternalClient
{
    protected string $partnerKey;

    protected string $code;

    protected string $sessionId = '';

    protected string $baseUrl;

    protected function baseUrl(): string
    {
        return $this->baseUrl;
    }

    public function clientName(): string
    {
        return 'imuis';
    }

    public function connect(
        array $credentials
    ): void {

        $this->partnerKey = $credentials['partnerKey'];
        $this->code = $credentials['code'];
        $this->baseUrl = $credentials['url'] ?? '';

        $this->login();
    }

    public function supports(string $externalName): bool
    {
        return $externalName === $this->clientName();
    }

    public function login(): void
    {
        if (empty($this->sessionId)) {
            $result = $this->imuisCall('LOGIN');
            $this->sessionId = $result['SESSION']['SESSIONID'];
        }
    }

    public function fetch(QueryDTO $query): iterable
    {
        yield $this->sessionId;
    }

    public function isConnected(): bool
    {
        if (empty($this->sessionId)) {
            return false;
        }

        return true;
    }

    public function getPartnerKey(): string
    {
        return $this->partnerKey;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getSessionId(): string
    {
        return $this->sessionId;
    }
}
