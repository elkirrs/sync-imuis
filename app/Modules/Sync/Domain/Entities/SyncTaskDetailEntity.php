<?php

declare(strict_types=1);

namespace App\Modules\Sync\Domain\Entities;

use App\Modules\Sync\Domain\ValueObject\DateTime;
use App\Modules\Sync\Domain\ValueObject\Details;
use App\Modules\Sync\Domain\ValueObject\Message;
use App\Modules\Sync\Domain\ValueObject\Status;
use App\Modules\Sync\Domain\ValueObject\UserId;
use App\Modules\Sync\Domain\ValueObject\UserType;
use App\Modules\Sync\Domain\ValueObject\Uuid;

class SyncTaskDetailEntity
{
    public function __construct(
        public Uuid $uuid {
            get {
                return $this->uuid;
            }
        },

        public Uuid $syncUuid {
            get {
                return $this->syncUuid;
            }
        },

        public UserId $userId {
            get {
                return $this->userId;
            }
        },

        public UserType $userType {
            get {
                return $this->userType;
            }
        },

        public Message $message {
            get {
                return $this->message;
            }
        },

        public Status $status {
            get {
                return $this->status;
            }
        },

        public ?Details $details = null {
            get {
                return $this->details;
            }
        },

        public ?DateTime $createdAt = null {
            get {
                return $this->createdAt;
            }
        }
    ) {
        if ($this->createdAt === null) {
            $this->createdAt = new DateTime;
        }
    }
}
