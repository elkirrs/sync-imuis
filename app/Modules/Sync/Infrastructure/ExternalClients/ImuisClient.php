<?php

declare(strict_types=1);

namespace App\Modules\Sync\Infrastructure\ExternalClients;

use App\Helpers\Helper;
use App\Modules\Sync\Domain\DTO\QueryDTO;
use App\Shared\Domain\Contracts\ExternalClient;
use App\Shared\Infrastructure\ExternalClient\AbstractExternalClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use RuntimeException;
use Throwable;

final class ImuisClient extends AbstractExternalClient implements ExternalClient
{
    protected ?string $sessionId = '';

    protected string $partnerKey;

    protected string $code;

    protected int $sessionIdExpiredAt;

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
        $this->partnerKey = $credentials['partner_key'];
        $this->code = $credentials['auth_code'];
        $this->baseUrl = $credentials['url'] ?? '';

        $this->login();
    }

    public function supports(string $externalName): bool
    {
        return $externalName === $this->clientName();
    }

    public function login(): void
    {
        $now = time();

        if (empty($this->sessionId) || ($this->sessionIdExpiredAt ?? 0) < ($now + 15)) {
            $result = $this->imuisCall('LOGIN');
            $this->sessionId = $result['SESSION']['SESSIONID'];
            $this->sessionIdExpiredAt = $now + 1800;
        }
    }

    public function fetch(QueryDTO $query): iterable
    {
        [
            $fields,
            $operations,
            $values
        ] = $this->generateFilters($query->filters);

        $dataSet = '
                    <NewDataSet>
                        <Table1>
                             <TABLE>'.$query->table.'</TABLE>
                             <SELECTFIELDS>'.$this->generateFields($query->fields).'</SELECTFIELDS>
                             <WHEREFIELDS>'.$fields.'</WHEREFIELDS>
                             <WHEREOPERATORS>'.$operations.'</WHEREOPERATORS>
                             <WHEREVALUES>'.$values.'</WHEREVALUES>
                             <ORDERBY>'.$this->generateSorts($query->sorts).'</ORDERBY>
                             <MAXRESULT>0</MAXRESULT>
                             <PAGESIZE>'.$query->pageSize.'</PAGESIZE>
                             <SELECTPAGE>{page}</SELECTPAGE>
                        </Table1>
                    </NewDataSet>
                    ';

        return $this->paginate('GETSTAMTABELRECORDS', $dataSet);
    }

    private function paginate(
        string $endpoint,
        string $opts,
        int $maxRetries = 5
    ): LazyCollection {

        return LazyCollection::make(function () use ($endpoint, $opts, $maxRetries) {

            $page = 1;
            $totalPages = null;

            while ($totalPages === null || $page <= $totalPages) {
                $attempt = 0;
                $success = false;

                while ($attempt < $maxRetries && ! $success) {
                    try {
                        $options = str_replace('{page}', (string) $page, $opts);
                        $response = $this->imuisCall($endpoint, $options);

                        if (empty($response['DATA'])) {
                            unset($response);
                            Log::warning("Page {$page} returned empty data");
                            throw new RuntimeException("Empty data on page {$page}");
                        }

                        $oneRow = array_first($response['DATA'])
                            |> (fn($x) => is_array($x))
                            |> (fn($x) => empty($x));

                        if ($oneRow) {
                            yield $response['DATA'];
                            return;
                        }

                        foreach ($response['DATA'] as $row) {
                            yield $row;
                        }

                        if ($totalPages === null) {
                            $totalPages = (int) ($response['METADATA']['TOTALPAGES'] ?? 1);
                        }

                        $success = true;

                    } catch (Throwable $th) {
                        $attempt++;
                        Log::warning("Page {$page} failed attempt {$attempt}: ", Helper::LogErrorData($th));

                        if ($attempt >= $maxRetries) {

                            throw new RuntimeException(
                                "Failed to fetch page {$page} after {$maxRetries} attempts. Process stopped. ".$th->getMessage()
                            );
                        }

                        pow(2, $attempt)
                            |> (fn ($x) => min($x, 180))
                            |> sleep(...);
                    }
                }

                $page++;
            }
        });
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getPartnerKey(): string
    {
        return $this->partnerKey;
    }

    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    private function generateFields(
        array $fields,
    ): string {

        return implode(';', $fields);
    }

    private function generateFilters(
        array $filters,
    ): array {

        $out = [];
        foreach ($filters as $value) {
            if (is_array($value)) {
                $out['fields'][] = $value[0];
                $out['operators'][] = $value[1];
                $out['values'][] = $value[2];
            } else {
                $out['fields'] = [$value];
                $out['operators'] = ['&gt;'];
                $out['values'] = [1];
            }
        }

        return [
            implode(';', $out['fields']),
            implode(';', $out['operators']),
            implode(';', $out['values']),
        ];
    }

    private function generateSorts(
        array $sorts,
    ): string {

        return implode(';', $sorts);
    }
}
