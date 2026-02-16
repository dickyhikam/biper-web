@extends('admin.layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('breadcrumb', 'Edit User')

@section('content')

    <div class="card border-0 rounded-lg max-w-2xl">
        <div class="card-body p-6">
            <h6 class="font-bold text-lg mb-4">Form Edit User</h6>

            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name', $user->name) }}"
                           class="form-control w-full rounded-lg @error('name') border-danger-500 @enderror"
                           placeholder="Masukkan nama lengkap" required>
                    @error('name')
                        <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Email
                    </label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', $user->email) }}"
                           class="form-control w-full rounded-lg @error('email') border-danger-500 @enderror"
                           placeholder="Masukkan email" required>
                    @error('email')
                        <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Role
                    </label>
                    <select name="role" id="role"
                            class="form-select w-full rounded-lg @error('role') border-danger-500 @enderror" required>
                        @foreach ($roles as $value => $label)
                            <option value="{{ $value }}" {{ old('role', $user->role) === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Password <span class="text-neutral-400 font-normal">(kosongkan jika tidak ingin mengubah)</span>
                    </label>
                    <input type="password" name="password" id="password"
                           class="form-control w-full rounded-lg @error('password') border-danger-500 @enderror"
                           placeholder="Masukkan password baru">
                    @error('password')
                        <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control w-full rounded-lg"
                           placeholder="Ulangi password baru">
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                            class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                        <iconify-icon icon="solar:check-circle-outline" class="text-lg"></iconify-icon>
                        Perbarui
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                       class="bg-neutral-200 dark:bg-neutral-600 hover:bg-neutral-300 dark:hover:bg-neutral-500 text-neutral-700 dark:text-white px-6 py-2.5 rounded-lg font-medium transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
