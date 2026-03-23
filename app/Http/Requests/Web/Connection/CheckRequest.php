

<?php

declare(strict_types=1);

namespace App\Http\Requests\Web\Connection;

use App\Http\Requests\Web\WebRequest;

final class CheckRequest extends WebRequest
{
    public function rules(): array
    {
        return [
            'administration_code' => ['bail', 'required', 'string'],
            'partner_key' => ['bail', 'required', 'string'],
            'auth_code' => ['bail', 'required', 'string'],
            'url' => ['bail', 'required', 'string'],
        ];
    }
}
