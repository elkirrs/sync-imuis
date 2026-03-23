<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Connection;

use App\Http\Requests\Web\WebRequest;
use App\Shared\Enums\ImuisDataTableEnum;

final class UpdateRequest extends WebRequest
{
    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string'],
            'description' => ['bail', 'nullable', 'string'],
            'is_active' => ['bail', 'required', 'string', 'in:0,1'],
            'administration_code' => ['bail', 'required', 'string'],
            'partner_key' => ['bail', 'required', 'string'],
            'auth_code' => ['bail', 'required', 'string'],
            'url' => ['bail', 'required', 'string'],
            'tables' => ['bail', 'required', 'array', 'min:1'],
            'tables.*' => ['bail', 'required', 'string', 'in:'.ImuisDataTableEnum::toStringList()],
        ];
    }
}
