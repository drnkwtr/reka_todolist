<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!\Auth::check()) {
            return redirect(route('auth.login'));
        }
        return $next($request);
    }
}
