<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorization
{
    public array $except = [
        'login',
    ];

    public function handle(Request $request, Closure $next)
    {
        if (! auth()->check()) {
            if (array_any($this->except, fn ($route) => $request->is($route))) {
                return $next($request);
            }

            return redirect()->route('login');
        }

        return $next($request);
    }
}
