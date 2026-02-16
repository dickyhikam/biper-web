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

    <div class="card border-0 rounded-lg">
        <div class="card-body p-6">
            <div class="flex items-center flex-wrap gap-2 justify-between mb-4">
                <h6 class="font-bold text-lg mb-0">Daftar User</h6>
                @if (auth('admin')->user()->canManageUsers())
                    <a href="{{ route('admin.users.create') }}"
                       class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition">
                        <iconify-icon icon="solar:add-circle-outline" class="text-lg"></iconify-icon>
                        Tambah User
                    </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="table bordered-table sm-table mb-0 table-auto w-full">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Dibuat</th>
                            @if (auth('admin')->user()->canManageUsers())
                                <th scope="col" class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-full flex justify-center items-center shrink-0 me-2 font-semibold">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <span class="font-medium">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
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
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                @if (auth('admin')->user()->canManageUsers())
                                    <td class="text-center">
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
                                <td colspan="{{ auth('admin')->user()->canManageUsers() ? 6 : 5 }}" class="text-center py-8 text-neutral-500">
                                    Belum ada data user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
