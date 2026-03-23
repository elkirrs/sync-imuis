<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\ValueObject;

use InvalidArgumentException;

final class Option
{
    public function __construct(
        public DataBaseName $nameDB {
            get {
                return $this->nameDB;
            }
        },
        public AdministrationId $administrationId {
            get {
                return $this->administrationId;
            }
        },
    ) {
        if (empty($nameDB->value)) {
            throw new InvalidArgumentException('NameDB cannot be empty');
        }

        if (empty($administrationId->value)) {
            throw new InvalidArgumentException('AdministrationId cannot be empty');
        }
    }

    public static function fromJson(
        string $value
    ): self {
        $data = json_decode($value, true);

        return new self(
            nameDB: new DataBaseName($data['db_name']),
            administrationId: new AdministrationId($data['administration_id']),
        );
    }

    public function toArray(): array
    {
        return [
            'db_name' => $this->nameDB->value,
            'administration_id' => $this->administrationId->value,
        ];
    }

    public function toJson(): false|string
    {
        $option = [
            'db_name' => $this->nameDB->value,
            'administration_id' => $this->administrationId->value,
        ];

        return json_encode($option);
    }
}
