<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeUserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password as PasswordBroker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = User::where('role', '!=', User::ROLE_PELANGGAN)
            ->where('role', '!=', User::ROLE_BIDAN_TERAPIS)
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate($perPage)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    private function adminRoles(): array
    {
        return collect(User::ROLES)->except(User::ROLE_PELANGGAN)->except(User::ROLE_BIDAN_TERAPIS)->all();
    }

    public function create()
    {
        $roles = $this->adminRoles();

        return view('admin.users.form', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'string', Rule::in(array_keys($this->adminRoles()))],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'address' => ['nullable', 'string', 'max:500'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ]);

        $validated['password'] = Str::random(32);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('users', 'public');
        }

        $user = User::create($validated);

        $token = PasswordBroker::broker()->createToken($user);
        $setPasswordUrl = route('admin.set-password', ['token' => $token, 'email' => $user->email]);

        try {
            Mail::to($user)->send(new WelcomeUserMail($user, $setPasswordUrl));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil ditambahkan, namun email gagal dikirim.');
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan. Email undangan telah dikirim ke ' . $user->email);
    }

    public function edit(User $user)
    {
        $roles = $this->adminRoles();

        return view('admin.users.form', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role' => ['required', 'string', Rule::in(array_keys($this->adminRoles()))],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'address' => ['nullable', 'string', 'max:500'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $validated['photo'] = $request->file('photo')->store('users', 'public');
        } else {
            unset($validated['photo']);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth('admin')->id()) {
            return response()->json(['message' => 'Anda tidak bisa menonaktifkan akun sendiri.'], 403);
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return response()->json(['message' => "User berhasil {$status}.", 'is_active' => $user->is_active]);
    }

    public function resendInvitation(User $user)
    {
        if ($user->email_verified_at) {
            return response()->json(['message' => 'User sudah verifikasi email.'], 422);
        }

        PasswordBroker::broker()->deleteToken($user);
        $token = PasswordBroker::broker()->createToken($user);
        $setPasswordUrl = route('admin.set-password', ['token' => $token, 'email' => $user->email]);

        try {
            Mail::to($user)->send(new WelcomeUserMail($user, $setPasswordUrl));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengirim email. Coba lagi nanti.'], 500);
        }

        return response()->json(['message' => 'Email undangan berhasil dikirim ulang ke ' . $user->email]);
    }

    public function destroy(User $user)
    {
        if ($user->id === auth('admin')->id()) {
            return response()->json(['message' => 'Anda tidak bisa menghapus akun sendiri.'], 403);
        }

        if (!$user->created_at->isToday()) {
            return response()->json(['message' => 'User hanya bisa dihapus pada hari yang sama saat dibuat.'], 403);
        }

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus.']);
    }
}
