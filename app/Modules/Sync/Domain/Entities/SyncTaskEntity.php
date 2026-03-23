<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\Entities;

use App\Modules\Sync\Domain\ValueObject\Attempts;
use App\Modules\Sync\Domain\ValueObject\DateTime;
use App\Modules\Sync\Domain\ValueObject\Name;
use App\Modules\Sync\Domain\ValueObject\Option;
use App\Modules\Sync\Domain\ValueObject\Status;
use App\Modules\Sync\Domain\ValueObject\Uuid;
use App\Modules\Sync\Enums\SyncTaskStatusEnum;
use DomainException;

class SyncTaskEntity
{
    public function __construct(
        public Uuid $uuid {
            get {
                return $this->uuid;
            }
        },

        public Name $name {
            get {
                return $this->name;
            }
        },

        public Status $status {
            get {
                return $this->status;
            }
        },

        public Option $options {
            get {
                return $this->options;
            }
        },

        public Attempts $attempts {
            get {
                return $this->attempts;
            }
        },

        public DateTime $availableAt {
            get {
                return $this->availableAt;
            }
        },
        public DateTime $createdAt {
            get {
                return $this->createdAt;
            }
        },

        public ?DateTime $updatedAt = null {
            get {
                return $this->updatedAt;
            }
        },
        public ?DateTime $finishedAt = null {
            get {
                return $this->finishedAt;
            }
        },

    ) {

        if ($this->updatedAt === null) {
            $this->updatedAt = new DateTime(date('Y-m-d H:i:s'));
        }
    }

    public function start(): void
    {
        if ($this->status->value !== SyncTaskStatusEnum::Processing->value) {
            throw new DomainException('Job already started');
        }

        $this->status = new Status(SyncTaskStatusEnum::Started->value);
        $this->updatedAt = new DateTime(date('Y-m-d H:i:s'));
    }

    public function created(): void
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $this->status = new Status(SyncTaskStatusEnum::Created->value);
        $this->createdAt = new DateTime($currentDateTime);
        $this->updatedAt = new DateTime($currentDateTime);
    }

    public function waiting(): void
    {
        $this->status = new Status(SyncTaskStatusEnum::Waiting->value);
        $this->updatedAt = new DateTime(date('Y-m-d H:i:s'));
    }

    public function queue(): void
    {
        $this->status = new Status(SyncTaskStatusEnum::Queue->value);
        $this->updatedAt = new DateTime(date('Y-m-d H:i:s'));
    }

    public function processing(): void
    {
        $this->status = new Status(SyncTaskStatusEnum::Processing->value);
        $this->updatedAt = new DateTime(date('Y-m-d H:i:s'));
        $this->attempts = new Attempts($this->attempts->value + 1);
    }

    public function finished(): void
    {
        $this->status = new Status(SyncTaskStatusEnum::Finished->value);
        $currentDateTime = date('Y-m-d H:i:s');
        $this->updatedAt = new DateTime($currentDateTime);
        $this->finishedAt = new DateTime($currentDateTime);
    }

    public function duplicate(): void
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $this->status = new Status(SyncTaskStatusEnum::Duplicate->value);
        $this->updatedAt = new DateTime($currentDateTime);
        $this->finishedAt = new DateTime($currentDateTime);
    }

    public function failed(): void
    {
        $this->status = new Status(SyncTaskStatusEnum::Failed->value);
        $this->updatedAt = new DateTime(date('Y-m-d H:i:s'));
    }

    public function status(): Status
    {
        return $this->status;
    }
}
