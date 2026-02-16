<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BidanController extends Controller
{
    public function index()
    {
        $bidans = Bidan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

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
            $rules['password'] = ['required', 'string', 'min:8'];
        } else {
            $rules['user_id'] = ['nullable', 'exists:users,id', 'unique:bidans,user_id'];
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($request, $validated, $isNewAccount) {
            if ($isNewAccount) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => User::ROLE_BIDAN_TERAPIS,
                ]);
                $validated['user_id'] = $user->id;
                unset($validated['email'], $validated['password']);
            }

            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')->store('bidans', 'public');
            }

            if (isset($validated['schedule'])) {
                $validated['schedule'] = array_filter($validated['schedule'], function ($day) {
                    return !empty($day['start']) && !empty($day['end']);
                });
            }

            $validated['is_active'] = $request->boolean('is_active', true);

            Bidan::create($validated);
        });

        return redirect()
            ->route('admin.bidans.index')
            ->with('success', 'Data bidan/terapis berhasil ditambahkan.');
    }

    public function show(Bidan $bidan)
    {
        $bidan->load('user');

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
            $rules['password'] = ['required', 'string', 'min:8'];
        } else {
            $rules['user_id'] = ['nullable', 'exists:users,id', "unique:bidans,user_id,{$bidan->id}"];
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($request, $validated, $isNewAccount, $bidan) {
            if ($isNewAccount) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => User::ROLE_BIDAN_TERAPIS,
                ]);
                $validated['user_id'] = $user->id;
                unset($validated['email'], $validated['password']);
            }

            if ($request->hasFile('photo')) {
                if ($bidan->photo) {
                    Storage::disk('public')->delete($bidan->photo);
                }
                $validated['photo'] = $request->file('photo')->store('bidans', 'public');
            } else {
                unset($validated['photo']);
            }

            if (isset($validated['schedule'])) {
                $validated['schedule'] = array_filter($validated['schedule'], function ($day) {
                    return !empty($day['start']) && !empty($day['end']);
                });
            }

            $validated['is_active'] = $request->boolean('is_active', true);

            $bidan->update($validated);
        });

        return redirect()
            ->route('admin.bidans.index')
            ->with('success', 'Data bidan/terapis berhasil diperbarui.');
    }

    public function destroy(Bidan $bidan)
    {
        if ($bidan->photo) {
            Storage::disk('public')->delete($bidan->photo);
        }

        $bidan->delete();

        return redirect()
            ->route('admin.bidans.index')
            ->with('success', 'Data bidan/terapis berhasil dihapus.');
    }
}
