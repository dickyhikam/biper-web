<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        // Sudah login sebagai admin → langsung ke dashboard
        if ($this->guard()->check() && $this->guard()->user()->hasRole([
            User::ROLE_SUPER_ADMIN, User::ROLE_OWNER, User::ROLE_ADMIN, User::ROLE_BIDAN_TERAPIS
        ])) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);

        if ($this->guard()->attempt($credentials, $request->boolean('remember'))) {
            $user = $this->guard()->user();

            // Hanya role admin yang boleh login di sini
            if ($user->isBidanTerapis() || $user->isAdmin() || $user->isOwner() || $user->isSuperAdmin()) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            // Bukan role admin, logout dan tolak
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Akun Anda tidak memiliki akses ke panel admin.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
