<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\v1\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        return view('auth.login');
    }

    public function showRegisterPage()
    {
        return view('auth.register');
    }
    public function login(LoginRequest $request, AuthService $service)
    {
        $credentials = $request->validated();
        try {
            $service->handleLogin($credentials);
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
        return redirect(route('homepage'));
    }

    public function logout(AuthService $service)
    {
        $service->handleLogout();
        return redirect(route('homepage'));
    }

    public function register(RegisterRequest $request, AuthService $service)
    {
        $credentials = $request->validated();
        $service->handleRegister($credentials);
        return redirect(route('homepage'));
    }
}
