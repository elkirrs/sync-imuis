<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ExternalClient;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

abstract class AbstractExternalClient
{
    protected function imuisCall(
        string $action,
        string $select = '',
        int $timeout = 60,
        int $retry = 3
    ): array {

        try {

            $response = Http::asForm()
                ->retry($retry, 2000)
                ->timeout($timeout)
                ->withHeaders([
                    'Content-type' => 'application/x-www-form-urlencoded',
                ])
                ->post($this->baseUrl(), [
                    'PARTNERKEY' => $this->getPartnerKey(),
                    'OMGEVINGSCODE' => $this->getCode(),
                    'SESSIONID' => $this->getSessionId(),
                    'ACTIE' => $action,
                    'SELECTIE' => $select,
                ])
                ->throw();

        } catch (Throwable $e) {
            Log::error('imuisCall', Helper::LogErrorData($e));
            throw new \RuntimeException($e->getMessage());
        }

        libxml_use_internal_errors(true);

        $xml = simplexml_load_string(
            $response->body(),
            'SimpleXMLElement',
            LIBXML_NOCDATA
        );

        $json = json_encode($xml);
        $data = json_decode($json, true);

        if (isset($data['ERROR']['MESSAGE'])) {
            throw new BadRequestException($data['ERROR']['MESSAGE']);
        }

        return $data;
    }

    abstract protected function baseUrl(): string;

    abstract public function getPartnerKey(): string;

    abstract public function getCode(): string;

    abstract public function getSessionId(): string;
}
