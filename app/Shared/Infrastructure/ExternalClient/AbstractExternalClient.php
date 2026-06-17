<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ExternalClient;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;
use XMLReader;

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
                ->withoutVerifying()
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
            throw new RuntimeException($e->getMessage());
        }

        $body = $response->body();

        if (
            $body === null
            || trim($body) === ''
        ) {
            throw new RuntimeException('Empty response body');
        }

        $body = trim($body);

        if (! str_starts_with($body, '<')) {
            throw new RuntimeException('Response is not valid XML');
        }

        libxml_use_internal_errors(true);

        $reader = new XMLReader;

        if (! $reader->XML(
            $body,
            'UTF-8',
            LIBXML_NOCDATA | LIBXML_PARSEHUGE
        )) {
            throw new RuntimeException('Cannot read XML');
        }

        $data = $this->xmlReaderToArray($reader);

        $reader->close();

        if (isset($data['NewDataSet'])) {
            $data = $data['NewDataSet'];
        }

        if (isset($data['ERROR']['MESSAGE'])) {
            throw new BadRequestException($data['ERROR']['MESSAGE']);
        }

        return $data;
    }

    abstract protected function baseUrl(): string;

    abstract public function getPartnerKey(): string;

    abstract public function getCode(): string;

    abstract public function getSessionId(): string;

    protected function xmlReaderToArray(
        XMLReader $reader
    ): array {
        $result = [];
        $stack = [];

        while ($reader->read()) {

            if ($reader->nodeType === XMLReader::ELEMENT) {

                $node = [
                    'name' => $reader->name,
                    'value' => null,
                    'children' => [],
                ];

                if ($reader->isEmptyElement) {

                    $value = '';

                    if (empty($stack)) {

                        $this->appendNode($result, $reader->name, $value);
                    } else {

                        $parentIndex = array_key_last($stack);

                        $this->appendNode(
                            $stack[$parentIndex]['children'],
                            $reader->name,
                            $value
                        );
                    }

                    continue;
                }

                $stack[] = $node;

                continue;
            }

            if (
                $reader->nodeType === XMLReader::TEXT
                || $reader->nodeType === XMLReader::CDATA
            ) {

                if (! empty($stack)) {

                    $index = array_key_last($stack);

                    $stack[$index]['value'] =
                        ($stack[$index]['value'] ?? '').$reader->value;
                }

                continue;
            }

            if ($reader->nodeType === XMLReader::END_ELEMENT) {

                $node = array_pop($stack);

                $value = ! empty($node['children'])
                    ? $node['children']
                    : trim((string) $node['value']);

                if (empty($stack)) {

                    $this->appendNode($result, $node['name'], $value);
                } else {

                    $parentIndex = array_key_last($stack);

                    $this->appendNode(
                        $stack[$parentIndex]['children'],
                        $node['name'],
                        $value
                    );
                }
            }
        }

        return $result;
    }

    protected function appendNode(
        array &$target,
        string $key,
        mixed $value
    ): void {
        if (! isset($target[$key])) {
            $target[$key] = $value;

            return;
        }

        if (! is_array($target[$key]) || ! array_is_list($target[$key])) {
            $target[$key] = [$target[$key]];
        }

        $target[$key][] = $value;
    }
}
