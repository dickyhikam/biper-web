@extends('admin.layouts.app')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')
@section('breadcrumb', 'Manajemen User')

@section('content')

@if (session('success'))
<div class="mb-4 p-4 bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 rounded-lg border border-success-200 dark:border-success-600/50 flex items-center gap-2">
    <iconify-icon icon="solar:check-circle-outline" class="text-xl"></iconify-icon>
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="mb-4 p-4 bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 rounded-lg border border-danger-200 dark:border-danger-600/50 flex items-center gap-2">
    <iconify-icon icon="solar:danger-triangle-outline" class="text-xl"></iconify-icon>
    {{ session('error') }}
</div>
@endif

<div class="bg-white dark:bg-neutral-700 rounded-2xl border border-gray-100 dark:border-neutral-600 shadow-sm overflow-hidden">

    {{-- Header --}}
    <div class="px-5 py-4 border-b border-gray-100 dark:border-neutral-600">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <h6 class="font-bold text-lg mb-0">Daftar User</h6>
                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-3 py-1 rounded-full text-xs font-semibold">
                    {{ $users->total() }} User
                </span>
            </div>
            @if (auth('admin')->user()->canManageUsers())
            <a href="{{ route('admin.users.create') }}"
                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition">
                <iconify-icon icon="solar:add-circle-outline" class="text-lg"></iconify-icon>
                Tambah User
            </a>
            @endif
        </div>

        {{-- Search & Per Page --}}
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2 flex-1" style="min-width: 200px; max-width: 420px;">
                <div class="relative flex-1">
                    <iconify-icon icon="solar:magnifer-linear" class="absolute top-1/2 -translate-y-1/2 text-gray-400 text-lg" style="left: 0.875rem;"></iconify-icon>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="form-control w-full rounded-lg text-sm" style="padding-left: 2.75rem;">
                </div>
            </div>
            <div class="flex items-center gap-2">
                <label class="text-sm text-neutral-500 dark:text-neutral-400">Tampilkan</label>
                <select name="per_page" onchange="this.form.submit()"
                    class="form-select rounded-lg text-sm" style="width: auto;">
                    @foreach ([10, 25, 50] as $size)
                    <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
                    @endforeach
                </select>
                <label class="text-sm text-neutral-500 dark:text-neutral-400">data</label>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-auto" style="max-height: calc(100vh - 24rem);">
        <table class="w-full" style="min-width: 600px;">
            <thead class="bg-gray-50 dark:bg-neutral-800 border-b border-gray-100 dark:border-neutral-600 sticky top-0 z-10">
                <tr>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider w-12">No</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Foto</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Nama</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Email</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Role</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Dibuat</th>
                    @if (auth('admin')->user()->canManageUsers())
                    <th class="px-5 py-3 text-center text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider w-24">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-neutral-600 text-sm">
                @forelse ($users as $index => $user)
                <tr class="group hover:bg-gray-50/80 dark:hover:bg-neutral-600/50 transition-colors">
                    <td class="px-5 py-3 text-gray-500 dark:text-neutral-400">{{ $users->firstItem() + $index }}</td>
                    <td class="px-5 py-3">
                        @php $nameParts = explode(' ', $user->name); $initials = strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : ''); @endphp
                        <div class="w-10 h-10 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-full flex justify-center items-center shrink-0 font-semibold text-xs">
                            {{ $initials }}
                        </div>
                    </td>
                    <td class="px-5 py-3">
                        <span class="font-medium text-gray-800 dark:text-neutral-200 whitespace-nowrap">{{ $user->name }}</span>
                    </td>
                    <td class="px-5 py-3 text-gray-600 dark:text-neutral-300">{{ $user->email }}</td>
                    <td class="px-5 py-3">
                        @php
                            $badgeColors = [
                                'super_admin' => 'bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400',
                                'owner' => 'bg-purple-100 dark:bg-purple-600/25 text-purple-600 dark:text-purple-400',
                                'admin' => 'bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400',
                                'bidan_terapis' => 'bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400',
                            ];
                        @endphp
                        <span class="{{ $badgeColors[$user->role] ?? '' }} px-3 py-1 rounded-full text-xs font-medium">
                            {{ $user->role_label }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-gray-600 dark:text-neutral-300 whitespace-nowrap">{{ $user->created_at->format('d M Y') }}</td>
                    @if (auth('admin')->user()->canManageUsers())
                    <td class="px-5 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="w-8 h-8 bg-warning-100 dark:bg-warning-600/25 text-warning-600 rounded-full flex items-center justify-center hover:bg-warning-200 transition"
                                title="Edit">
                                <iconify-icon icon="solar:pen-outline" class="text-sm"></iconify-icon>
                            </a>
                            @if ($user->id !== auth('admin')->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 bg-danger-100 dark:bg-danger-600/25 text-danger-600 rounded-full flex items-center justify-center hover:bg-danger-200 transition"
                                    title="Hapus">
                                    <iconify-icon icon="solar:trash-bin-trash-outline" class="text-sm"></iconify-icon>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth('admin')->user()->canManageUsers() ? 7 : 6 }}">
                        <div class="flex flex-col items-center justify-center py-16 px-4">
                            <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-primary-100 to-primary-50 dark:from-primary-600/15 dark:to-primary-600/5 flex items-center justify-center mb-5">
                                <iconify-icon icon="solar:users-group-rounded-bold-duotone" style="font-size: 48px;" class="text-primary-400 dark:text-primary-500"></iconify-icon>
                            </div>
                            @if (request('search'))
                            <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Tidak ada hasil</h6>
                            <p class="text-sm text-neutral-400 dark:text-neutral-500 text-center">Tidak ditemukan user dengan kata kunci "{{ request('search') }}"</p>
                            @else
                            <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Belum ada data user</h6>
                            <p class="text-sm text-neutral-400 dark:text-neutral-500 mb-5 text-center">Mulai tambahkan user untuk mengelola akses sistem.</p>
                            @if (auth('admin')->user()->canManageUsers())
                            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 border border-primary-300 dark:border-primary-600 text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-600/10 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all">
                                <iconify-icon icon="solar:add-circle-bold" class="text-lg"></iconify-icon>
                                Tambah User Pertama
                            </a>
                            @endif
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($users->hasPages())
    <div class="px-5 py-4 border-t border-gray-100 dark:border-neutral-600 flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-neutral-400">
            Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} user
        </p>
        <div class="flex items-center gap-1">
            @if ($users->onFirstPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-300 dark:text-neutral-600 cursor-not-allowed">
                <iconify-icon icon="solar:alt-arrow-left-outline" class="text-lg"></iconify-icon>
            </span>
            @else
            <a href="{{ $users->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-neutral-400 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">
                <iconify-icon icon="solar:alt-arrow-left-outline" class="text-lg"></iconify-icon>
            </a>
            @endif

            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
            @if ($page == $users->currentPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-semibold text-white" style="background-color: #df1995;">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-medium text-gray-600 dark:text-neutral-300 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">{{ $page }}</a>
            @endif
            @endforeach

            @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-neutral-400 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">
                <iconify-icon icon="solar:alt-arrow-right-outline" class="text-lg"></iconify-icon>
            </a>
            @else
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-300 dark:text-neutral-600 cursor-not-allowed">
                <iconify-icon icon="solar:alt-arrow-right-outline" class="text-lg"></iconify-icon>
            </span>
            @endif
        </div>
    </div>
    @endif

</div>

@endsection
