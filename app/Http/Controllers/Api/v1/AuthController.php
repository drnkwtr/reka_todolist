<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\LoginRequest;
use App\Http\Resources\Api\v1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $attempt = Auth::attempt($request->validated());
        if (!$attempt) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid username or password',
            ], 401);
        }
        $user = Auth::user();
        $api_token = $user->id . '_' . $user->email . '_' . $user->password;
        $user->update(['api_token' => $api_token]);
        return response()->json([
            'success' => true,
            'user' => new UserResource($user)
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => new UserResource($request->user()),
        ]);
    }
}
