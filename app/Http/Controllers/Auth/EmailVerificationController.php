<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        $user = Auth::user();

        if (!$user || !$user->needsEmailVerification()) {
            return redirect()->route('pageHome');
        }

        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ], [
            'code.required' => 'Kode verifikasi wajib diisi.',
            'code.size' => 'Kode verifikasi harus 6 karakter.',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->verifyEmailWithCode($request->code)) {
            return redirect()->route('anak.create')
                ->with('message', 'Email berhasil diverifikasi! Sekarang tambahkan data anak Anda.');
        }

        return back()->withErrors([
            'code' => 'Kode verifikasi tidak valid atau sudah kadaluarsa.',
        ]);
    }

    public function resend()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('pageHome');
        }

        if (!$user->canResendVerificationCode()) {
            return back()->withErrors([
                'resend' => 'Mohon tunggu sebelum meminta kode baru. Maksimal 3 kali per jam.',
            ]);
        }

        $user->increment('email_verification_attempts');
        $code = $user->generateVerificationCode();

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($user, $code));

            return back()->with('message', 'Kode verifikasi baru telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            Log::error('Failed to resend verification email: ' . $e->getMessage());

            return back()->withErrors([
                'resend' => 'Gagal mengirim email. Silakan coba lagi.',
            ]);
        }
    }
}
