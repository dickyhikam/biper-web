<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Sudah login → redirect ke home
        if (Auth::check()) {
            return redirect()->route('pageHome');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $authCredentials = [
            'email' => $credentials['login'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($authCredentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->needsEmailVerification()) {
                return redirect()->route('verification.notice');
            }

            if ($user->needsChildData()) {
                return redirect()->route('anak.create');
            }

            return redirect()->intended(route('pageHome'));
        }

        return back()->withErrors([
            'login' => 'Email atau password salah.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
