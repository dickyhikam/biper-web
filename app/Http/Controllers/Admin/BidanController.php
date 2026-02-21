<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeUserMail;
use App\Models\Bidan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BidanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = Bidan::orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('specialization', 'like', "%{$search}%")
                  ->orWhere('str_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                  });
            });
        }

        $bidans = $query->paginate($perPage)->withQueryString();

        return view('admin.bidans.index', compact('bidans'));
    }

    public function create()
    {
        $availableUsers = User::where('role', User::ROLE_BIDAN_TERAPIS)
            ->whereDoesntHave('bidan')
            ->orderBy('name')
            ->get();

        return view('admin.bidans.form', compact('availableUsers'));
    }

    public function store(Request $request)
    {
        $isNewAccount = $request->input('user_id') === 'new';

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'credential' => ['nullable', 'string', 'max:100'],
            'specialization' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'str_number' => ['nullable', 'string', 'max:100'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:50'],
            'employment_type' => ['required', 'string', 'in:fulltime,freelance'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'address' => ['nullable', 'string', 'max:500'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'schedule' => ['nullable', 'array'],
            'schedule.*.start' => ['nullable', 'date_format:H:i'],
            'schedule.*.end' => ['nullable', 'date_format:H:i'],
            'is_active' => ['boolean'],
        ];

        if ($isNewAccount) {
            $rules['email'] = ['required', 'email', 'max:255', 'unique:users,email'];
        } else {
            $rules['user_id'] = ['required', 'exists:users,id', 'unique:bidans,user_id'];
        }

        $validated = $request->validate($rules);

        $newUser = null;

        DB::transaction(function () use ($request, $validated, $isNewAccount, &$newUser) {
            if ($isNewAccount) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,
                    'password' => Str::random(32),
                    'role' => User::ROLE_BIDAN_TERAPIS,
                ]);
                $validated['user_id'] = $user->id;
                $newUser = $user;
                unset($validated['email']);
            } else {
                $user = User::findOrFail($validated['user_id']);
                $user->update([
                    'name' => $validated['name'],
                    'phone' => $validated['phone'] ?? $user->phone,
                ]);
            }

            // Save photo/address/lat/lng to user
            $userData = [];
            if ($request->hasFile('photo')) {
                $userData['photo'] = $request->file('photo')->store('users', 'public');
            }
            $userData['address'] = $validated['address'] ?? null;
            $userData['latitude'] = $validated['latitude'] ?? null;
            $userData['longitude'] = $validated['longitude'] ?? null;
            $user->update($userData);

            // Remove user-level fields from bidan data
            unset($validated['name'], $validated['phone'], $validated['photo'], $validated['address'], $validated['latitude'], $validated['longitude']);

            if (isset($validated['schedule'])) {
                $validated['schedule'] = array_filter($validated['schedule'], function ($day) {
                    return !empty($day['start']) && !empty($day['end']);
                });
            }

            $validated['is_active'] = $request->boolean('is_active', true);

            Bidan::create($validated);
        });

        if ($newUser) {
            $token = Password::broker()->createToken($newUser);
            $setPasswordUrl = route('admin.set-password', ['token' => $token, 'email' => $newUser->email]);

            try {
                Mail::to($newUser)->send(new WelcomeUserMail($newUser, $setPasswordUrl));
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.bidans.index')
                    ->with('success', 'Data bidan/terapis berhasil ditambahkan, namun email gagal dikirim.');
            }
        }

        return redirect()
            ->route('admin.bidans.index')
            ->with('success', 'Data bidan/terapis berhasil ditambahkan.' . ($newUser ? ' Email undangan telah dikirim ke ' . $newUser->email : ''));
    }

    public function show(Bidan $bidan)
    {
        return view('admin.bidans.show', compact('bidan'));
    }

    public function edit(Bidan $bidan)
    {
        $availableUsers = User::where('role', User::ROLE_BIDAN_TERAPIS)
            ->where(function ($query) use ($bidan) {
                $query->whereDoesntHave('bidan')
                      ->orWhere('id', $bidan->user_id);
            })
            ->orderBy('name')
            ->get();

        return view('admin.bidans.form', compact('bidan', 'availableUsers'));
    }

    public function update(Request $request, Bidan $bidan)
    {
        $isNewAccount = $request->input('user_id') === 'new';

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'credential' => ['nullable', 'string', 'max:100'],
            'specialization' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'str_number' => ['nullable', 'string', 'max:100'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:50'],
            'employment_type' => ['required', 'string', 'in:fulltime,freelance'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'address' => ['nullable', 'string', 'max:500'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'schedule' => ['nullable', 'array'],
            'schedule.*.start' => ['nullable', 'date_format:H:i'],
            'schedule.*.end' => ['nullable', 'date_format:H:i'],
            'is_active' => ['boolean'],
        ];

        if ($isNewAccount) {
            $rules['email'] = ['required', 'email', 'max:255', 'unique:users,email'];
        } else {
            $rules['user_id'] = ['required', 'exists:users,id', "unique:bidans,user_id,{$bidan->id}"];
            $rules['password'] = ['nullable', 'confirmed', 'min:8'];
            $existingUser = User::findOrFail($request->input('user_id'));
            $rules['existing_email'] = ['required', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users', 'email')->ignore($existingUser->id)];
        }

        $validated = $request->validate($rules);

        $newUser = null;
        $emailChangedOnUnverified = false;

        DB::transaction(function () use ($request, $validated, $isNewAccount, $bidan, &$newUser, &$emailChangedOnUnverified) {
            if ($isNewAccount) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,
                    'password' => Str::random(32),
                    'role' => User::ROLE_BIDAN_TERAPIS,
                ]);
                $validated['user_id'] = $user->id;
                $newUser = $user;
                unset($validated['email']);
            } else {
                $user = User::findOrFail($validated['user_id']);
                $userData = [
                    'name' => $validated['name'],
                    'phone' => $validated['phone'] ?? $user->phone,
                ];
                if (!empty($validated['password'])) {
                    $userData['password'] = $validated['password'];
                }

                // Handle email change
                if (isset($validated['existing_email']) && $user->email !== $validated['existing_email']) {
                    $userData['email'] = $validated['existing_email'];
                    if (!$user->email_verified_at) {
                        $userData['email_verified_at'] = null;
                        $emailChangedOnUnverified = true;
                    }
                }

                $user->update($userData);
            }

            // Save photo/address/lat/lng to user
            $userData = [];
            if ($request->hasFile('photo')) {
                if ($user->photo) {
                    Storage::disk('public')->delete($user->photo);
                }
                $userData['photo'] = $request->file('photo')->store('users', 'public');
            }
            $userData['address'] = $validated['address'] ?? null;
            $userData['latitude'] = $validated['latitude'] ?? null;
            $userData['longitude'] = $validated['longitude'] ?? null;
            $user->update($userData);

            // Remove user-level fields from bidan data
            unset($validated['name'], $validated['phone'], $validated['photo'], $validated['address'], $validated['latitude'], $validated['longitude'], $validated['password'], $validated['existing_email']);

            if (isset($validated['schedule'])) {
                $validated['schedule'] = array_filter($validated['schedule'], function ($day) {
                    return !empty($day['start']) && !empty($day['end']);
                });
            }

            $validated['is_active'] = $request->boolean('is_active', true);

            $bidan->update($validated);
        });

        // Send welcome email for new account
        if ($newUser) {
            $token = Password::broker()->createToken($newUser);
            $setPasswordUrl = route('admin.set-password', ['token' => $token, 'email' => $newUser->email]);

            try {
                Mail::to($newUser)->send(new WelcomeUserMail($newUser, $setPasswordUrl));
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.bidans.index')
                    ->with('success', 'Data bidan/terapis berhasil diperbarui, namun email gagal dikirim.');
            }
        }

        // Send new welcome email if email changed on unverified user
        if ($emailChangedOnUnverified) {
            $user = $bidan->user->fresh();
            Password::broker()->deleteToken($user);
            $token = Password::broker()->createToken($user);
            $setPasswordUrl = route('admin.set-password', ['token' => $token, 'email' => $user->email]);

            try {
                Mail::to($user)->send(new WelcomeUserMail($user, $setPasswordUrl));

                return redirect()
                    ->route('admin.bidans.index')
                    ->with('success', 'Data bidan/terapis berhasil diperbarui. Email undangan telah dikirim ke ' . $user->email);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.bidans.index')
                    ->with('success', 'Data bidan/terapis berhasil diperbarui, namun email undangan gagal dikirim.');
            }
        }

        return redirect()
            ->route('admin.bidans.index')
            ->with('success', 'Data bidan/terapis berhasil diperbarui.' . ($newUser ? ' Email undangan telah dikirim ke ' . $newUser->email : ''));
    }

    public function resendInvitation(Bidan $bidan)
    {
        $user = $bidan->user;

        if ($user->email_verified_at) {
            return response()->json(['message' => 'User sudah verifikasi email.'], 422);
        }

        Password::broker()->deleteToken($user);
        $token = Password::broker()->createToken($user);
        $setPasswordUrl = route('admin.set-password', ['token' => $token, 'email' => $user->email]);

        try {
            Mail::to($user)->send(new WelcomeUserMail($user, $setPasswordUrl));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengirim email. Coba lagi nanti.'], 500);
        }

        return response()->json(['message' => 'Email undangan berhasil dikirim ulang ke ' . $user->email]);
    }

    public function destroy(Bidan $bidan)
    {
        if ($bidan->user->photo) {
            Storage::disk('public')->delete($bidan->user->photo);
        }

        $bidan->delete();

        return response()->json(['message' => 'Data bidan/terapis berhasil dihapus.']);
    }
}
