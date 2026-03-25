<?php

declare(strict_types=1);

namespace App\Modules\Connection\Domain\Entities;

use App\Modules\Connection\Domain\ValueObjects\Active;
use App\Modules\Connection\Domain\ValueObjects\CreatedDB;
use App\Modules\Connection\Domain\ValueObjects\Description;
use App\Modules\Connection\Domain\ValueObjects\Id;
use App\Modules\Connection\Domain\ValueObjects\Name;
use App\Modules\Connection\Domain\ValueObjects\Options;
use App\Modules\Connection\Domain\ValueObjects\Type;

class ConnectionEntity
{
    public function __construct(
        public ?Id $id {
            get {
                return $this->id;
            }
        },
        public ?Name $name = null {
            get {
                return $this->name;
            }
        },
        public ?Type $type = null {
            get {
                return $this->type;
            }
        },
        public ?Description $description = null {
            get {
                return $this->description;
            }
        },
        public ?Options $options = null {
            get {
                return $this->options;
            }
        },
        public Active $isActive = new Active(true) {
            get {
                return $this->isActive;
            }
        },

        public CreatedDB $isCreatedDB = new CreatedDB(false) {
            get {
                return $this->isCreatedDB;
            }
        },
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = new Id($id);
    }

    public function createdDB(bool $isCreateDB): void
    {
        $this->isCreatedDB = new CreatedDB($isCreateDB);
    }
}
