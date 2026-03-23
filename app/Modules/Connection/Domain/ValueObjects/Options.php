<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\ValueObjects;

final class Options
{
    public function __construct(
        public AdministrationCode $administrationCode {
            get {
                return $this->administrationCode;
            }
        },

        public PartnerKey $partnerKey {
            get {
                return $this->partnerKey;
            }
        },

        public AuthCode $authCode {
            get {
                return $this->authCode;
            }
        },

        public Url $url {
            get {
                return $this->url;
            }
        },

        public Tables $tables {
            get {
                return $this->tables;
            }
        }
    ) {
    }

    public static function fromJson(
        string $value
    ): self {
        $data = json_decode($value, true);

        return new self(
            administrationCode: new AdministrationCode($data['administration_code']),
            partnerKey: new PartnerKey($data['partner_key']),
            authCode: new AuthCode($data['auth_code']),
            url: new Url($data['url']),
            tables: new Tables($data['tables']),
        );
    }

    public function toArray(): array
    {
        return [
            'administration_code' => $this->administrationCode->value,
            'partner_key' => $this->partnerKey->value,
            'auth_code' => $this->authCode->value,
            'url' => $this->url->value,
            'tables' => $this->tables->value,
        ];
    }

    public function toJson(): false|string
    {
        $option = [
            'administration_code' => $this->administrationCode->value,
            'partner_key' => $this->partnerKey->value,
            'auth_code' => $this->authCode->value,
            'url' => $this->url->value,
            'tables' => $this->tables->value,
        ];

        return json_encode($option);
    }
}
