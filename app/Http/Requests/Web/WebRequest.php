<?php

declare(strict_types=1);

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

abstract class WebRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    abstract public function rules(): array;
}
