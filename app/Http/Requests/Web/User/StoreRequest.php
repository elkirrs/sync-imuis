<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\User;

use App\Http\Requests\Web\WebRequest;

final class StoreRequest extends WebRequest
{
    public function rules(): array
    {
        return [
            'username' => ['bail', 'required', 'string'],
            'email' => ['bail', 'required', 'email', 'unique:users,email'],
            'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
