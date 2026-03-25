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
        $dataSet = '
                    <NewDataSet>
                        <Table1>
                             <TABLE>'.$query->table.'</TABLE>
                             <SELECTFIELDS>'.$this->generateFields($query->fields).'</SELECTFIELDS>
                             <WHEREFIELDS>'.$this->generateFilters($query->filters).'</WHEREFIELDS>
                             <WHEREOPERATORS>&gt;</WHEREOPERATORS>
                             <WHEREVALUES>1</WHEREVALUES>
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

                        sleep(min(pow(2, $attempt), 180));
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
    ): string {

        return implode(';', $filters);
    }

    private function generateSorts(
        array $sorts,
    ): string {

        return implode(';', $sorts);
    }
}
