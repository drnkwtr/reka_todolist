<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthByApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $api_token = $request->header('Authorization');
        if (empty($api_token)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
        $api_token = str_replace('Bearer ', '', $api_token);
        $user = User::query()
            ->where('api_token', $api_token)
            ->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
        Auth::login($user);

        return $next($request);
    }
}
