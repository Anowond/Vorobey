<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        $cookie = '';
        if (isset($_COOKIE['laravel_cookie_consent'])) {
            $cookie = json_decode($_COOKIE['laravel_cookie_consent']);
        }
        return view('auth.login', [
                'cookie' => $cookie,
        ]);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($validated, (bool) $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended(config('app.home'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials !',
        ])->onlyInput('email');

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
