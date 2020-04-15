<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Acl
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (!is_null(Auth::user()) && Gate::denies($request->getPathInfo()))
            abort(403, 'Não autorizado');

        return $next($request);
    }
}
