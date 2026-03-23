<?php

declare(strict_types=1);

namespace App\Modules\User\Domain\Entities;

class UserSaveEntity
{
    public function __construct(
        public int $id {
            get {
                return $this->id;
            }
        },

        public string $userName {
            get {
                return $this->userName;
            }
        },

        public string $email {
            get {
                return $this->email;
            }
        },

        public ?string $password {
            get {
                return $this->password;
            }
        },

        public bool $isActive {
            get {
                return $this->isActive;
            }
        }
    ) {
    }
}
