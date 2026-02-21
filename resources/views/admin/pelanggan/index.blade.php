@extends('admin.layouts.app')

@section('title', 'Data Pelanggan')
@section('page-title', 'Data Pelanggan')
@section('breadcrumb', 'Data Pelanggan')

@section('content')

<div class="bg-white dark:bg-neutral-700 rounded-2xl border border-gray-100 dark:border-neutral-600 shadow-sm overflow-hidden">

    {{-- Header --}}
    <div class="px-5 py-4 border-b border-gray-100 dark:border-neutral-600">
        <div class="flex items-center justify-between mb-4">
            <h6 class="font-bold text-lg mb-0">Daftar Pelanggan</h6>
            <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-3 py-1 rounded-full text-xs font-semibold">
                {{ $pelanggans->total() }} Pelanggan
            </span>
        </div>

        {{-- Search & Per Page --}}
        <form method="GET" action="{{ route('admin.pelanggan.index') }}" class="flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2 flex-1" style="min-width: 200px; max-width: 420px;">
                <div class="relative flex-1">
                    <iconify-icon icon="solar:magnifer-linear" class="absolute top-1/2 -translate-y-1/2 text-gray-400 text-lg" style="left: 0.875rem;"></iconify-icon>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, email, atau no. HP..."
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
        <table class="w-full" style="min-width: 700px;">
            <thead class="bg-gray-50 dark:bg-neutral-800 border-b border-gray-100 dark:border-neutral-600 sticky top-0 z-10">
                <tr>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider w-12">No</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Pelanggan</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Email</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">WhatsApp</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider w-20">Anak</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Status</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Terdaftar</th>
                    <th class="px-5 py-3 text-center text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider w-16">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-neutral-600 text-sm">
                @forelse ($pelanggans as $index => $pelanggan)
                <tr class="group hover:bg-gray-50/80 dark:hover:bg-neutral-600/50 transition-colors">
                    <td class="px-5 py-3 text-gray-500 dark:text-neutral-400">{{ $pelanggans->firstItem() + $index }}</td>
                    <td class="px-5 py-3">
                        <div class="flex items-center">
                            <span class="font-medium text-gray-800 dark:text-neutral-200 whitespace-nowrap">{{ $pelanggan->nickname }} {{ $pelanggan->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-gray-600 dark:text-neutral-300">{{ $pelanggan->email }}</td>
                    <td class="px-5 py-3 text-gray-600 dark:text-neutral-300">{{ $pelanggan->phone ?? '-' }}</td>
                    <td class="px-5 py-3">
                        <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-2.5 py-0.5 rounded-full text-xs font-medium">
                            {{ $pelanggan->anaks_count }} anak
                        </span>
                    </td>
                    <td class="px-5 py-3">
                        @if ($pelanggan->hasVerifiedEmail())
                        <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-3 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1 whitespace-nowrap">
                            <iconify-icon icon="solar:check-circle-bold" class="text-sm"></iconify-icon>
                            Terverifikasi
                        </span>
                        @else
                        <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-3 py-1 rounded-full text-xs font-medium inline-flex items-center gap-1 whitespace-nowrap">
                            <iconify-icon icon="solar:clock-circle-outline" class="text-sm"></iconify-icon>
                            Belum Verifikasi
                        </span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-gray-600 dark:text-neutral-300 whitespace-nowrap">{{ $pelanggan->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-5 py-3 text-center">
                        <a href="{{ route('admin.pelanggan.show', $pelanggan) }}"
                            class="w-8 h-8 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-full inline-flex items-center justify-center hover:bg-primary-200 dark:hover:bg-primary-600/40 transition"
                            title="Lihat Detail">
                            <iconify-icon icon="solar:eye-outline" class="text-sm"></iconify-icon>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="flex flex-col items-center justify-center py-16 px-4">
                            <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-pink-100 to-pink-50 dark:from-pink-600/15 dark:to-pink-600/5 flex items-center justify-center mb-5">
                                <iconify-icon icon="flowbite:users-group-outline" style="font-size: 48px;" class="text-pink-400 dark:text-pink-500"></iconify-icon>
                            </div>
                            @if (request('search'))
                            <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Tidak ada hasil</h6>
                            <p class="text-sm text-neutral-400 dark:text-neutral-500 text-center">Tidak ditemukan pelanggan dengan kata kunci "{{ request('search') }}"</p>
                            @else
                            <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Belum ada pelanggan</h6>
                            <p class="text-sm text-neutral-400 dark:text-neutral-500 text-center">Pelanggan yang mendaftar dari website akan muncul di sini.</p>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($pelanggans->hasPages())
    <div class="px-5 py-4 border-t border-gray-100 dark:border-neutral-600 flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-neutral-400">
            Menampilkan {{ $pelanggans->firstItem() }} - {{ $pelanggans->lastItem() }} dari {{ $pelanggans->total() }} pelanggan
        </p>
        <div class="flex items-center gap-1">
            {{-- Previous --}}
            @if ($pelanggans->onFirstPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-300 dark:text-neutral-600 cursor-not-allowed">
                <iconify-icon icon="solar:alt-arrow-left-outline" class="text-lg"></iconify-icon>
            </span>
            @else
            <a href="{{ $pelanggans->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-neutral-400 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">
                <iconify-icon icon="solar:alt-arrow-left-outline" class="text-lg"></iconify-icon>
            </a>
            @endif

            {{-- Pages --}}
            @foreach ($pelanggans->getUrlRange(1, $pelanggans->lastPage()) as $page => $url)
            @if ($page == $pelanggans->currentPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-semibold text-white" style="background-color: #df1995;">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-medium text-gray-600 dark:text-neutral-300 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">{{ $page }}</a>
            @endif
            @endforeach

            {{-- Next --}}
            @if ($pelanggans->hasMorePages())
            <a href="{{ $pelanggans->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-neutral-400 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">
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