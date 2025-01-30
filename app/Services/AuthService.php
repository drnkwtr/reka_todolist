<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function handleLogin($credentials)
    {
        $user = Auth::attempt($credentials);
        if (!$user) {
            throw new \Exception('Email or password are incorrect');
        };
    }

    public function handleLogout()
    {
        Auth::logout();
    }

    public function handleRegister($credentials)
    {
        $user = User::create($credentials);
        Auth::login($user);
    }
}
