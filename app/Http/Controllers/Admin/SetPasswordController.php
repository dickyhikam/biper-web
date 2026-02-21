<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;

class SetPasswordController extends Controller
{
    public function showForm(string $token, Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            abort(404);
        }

        $user = User::where('email', $email)->first();

        if (!$user || !Password::broker()->tokenExists($user, $token)) {
            return view('admin.auth.link-expired');
        }

        return view('admin.auth.set-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Password::broker()->tokenExists($user, $request->token)) {
            return back()->withErrors(['email' => 'Link sudah tidak berlaku atau sudah digunakan.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        Password::broker()->deleteToken($user);

        return redirect()->route('admin.login')
            ->with('success', 'Password berhasil dibuat. Silakan login.');
    }
}
