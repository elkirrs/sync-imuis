<?php

declare(strict_types=1);

namespace App\Modules\Sync\Enums;

enum SyncTaskStatusEnum: int
{
    case Created = 1;
    case Waiting = 2;
    case Started = 3;
    case Processing = 4;
    case Finished = 5;
    case Failed = 6;
    case Queue = 7;
    case Duplicate = 8;

    public function toString(): string
    {
        return match ($this) {
            self::Created => 'created',
            self::Waiting => 'waiting',
            self::Started => 'started',
            self::Processing => 'processing',
            self::Finished => 'finished',
            self::Failed => 'failed',
            self::Queue => 'queue',
            self::Duplicate => 'duplicate',
        };
    }

    public static function fromString(string $status): self
    {
        return match ($status) {
            'created' => self::Created,
            'waiting' => self::Waiting,
            'started' => self::Started,
            'processing' => self::Processing,
            'finished' => self::Finished,
            'failed' => self::Failed,
            'queue' => self::Queue,
            'duplicate' => self::Duplicate,
            default => throw new \InvalidArgumentException("Unknown status: $status"),
        };
    }
}
