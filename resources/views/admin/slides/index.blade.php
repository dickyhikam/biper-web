@extends('admin.layouts.app')

@section('title', 'Slide / Banner')
@section('page-title', 'Slide / Banner')
@section('breadcrumb', 'Slide / Banner')

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
                <h6 class="font-bold text-lg mb-0">Daftar Slide / Banner</h6>
                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-3 py-1 rounded-full text-xs font-semibold">
                    {{ $slides->total() }} Slide
                </span>
            </div>
            @if (auth('admin')->user()->canManageSlides())
            <a href="{{ route('admin.slides.create') }}"
                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition">
                <iconify-icon icon="solar:add-circle-outline" class="text-lg"></iconify-icon>
                Tambah Slide
            </a>
            @endif
        </div>

        {{-- Search & Per Page --}}
        <form method="GET" action="{{ route('admin.slides.index') }}" class="flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2 flex-1" style="min-width: 200px; max-width: 420px;">
                <div class="relative flex-1">
                    <iconify-icon icon="solar:magnifer-linear" class="absolute top-1/2 -translate-y-1/2 text-gray-400 text-lg" style="left: 0.875rem;"></iconify-icon>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul atau subtitle..."
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
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Gambar</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Judul</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Warna</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Urutan</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Status</th>
                    @if (auth('admin')->user()->canManageSlides())
                    <th class="px-5 py-3 text-center text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider w-24">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-neutral-600 text-sm">
                @forelse ($slides as $index => $slide)
                <tr class="group hover:bg-gray-50/80 dark:hover:bg-neutral-600/50 transition-colors">
                    <td class="px-5 py-3 text-gray-500 dark:text-neutral-400">{{ $slides->firstItem() + $index }}</td>
                    <td class="px-5 py-3">
                        @if ($slide->image_url)
                        <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}"
                            class="w-20 h-12 rounded-lg object-cover">
                        @else
                        <div class="w-20 h-12 bg-neutral-100 dark:bg-neutral-600 rounded-lg flex items-center justify-center">
                            <iconify-icon icon="solar:gallery-bold-duotone" class="text-xl text-neutral-400"></iconify-icon>
                        </div>
                        @endif
                    </td>
                    <td class="px-5 py-3">
                        <div>
                            <span class="font-medium text-gray-800 dark:text-neutral-200">{{ $slide->title }}</span>
                            @if ($slide->subtitle)
                            <br><span class="text-xs text-neutral-400 line-clamp-1">{{ Str::limit($slide->subtitle, 50) }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-5 py-3">
                        @php
                            $colorClasses = [
                                'pink' => 'bg-primary-100 dark:bg-primary-600/25 text-primary-600',
                                'blue' => 'bg-info-100 dark:bg-info-600/25 text-info-600 dark:text-info-400',
                                'dark' => 'bg-neutral-200 dark:bg-neutral-600 text-neutral-700 dark:text-neutral-300',
                            ];
                        @endphp
                        <span class="{{ $colorClasses[$slide->overlay_color] ?? $colorClasses['pink'] }} px-3 py-1 rounded-full text-xs font-medium">
                            {{ App\Models\Slide::OVERLAY_LABELS[$slide->overlay_color] ?? 'Pink' }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-gray-600 dark:text-neutral-300">
                        <span class="font-medium">{{ $slide->sort_order }}</span>
                    </td>
                    <td class="px-5 py-3">
                        @if ($slide->is_active)
                        <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-3 py-1 rounded-full text-xs font-medium">
                            Aktif
                        </span>
                        @else
                        <span class="bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 px-3 py-1 rounded-full text-xs font-medium">
                            Nonaktif
                        </span>
                        @endif
                    </td>
                    @if (auth('admin')->user()->canManageSlides())
                    <td class="px-5 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.slides.edit', $slide) }}"
                                class="w-8 h-8 bg-warning-100 dark:bg-warning-600/25 text-warning-600 rounded-full flex items-center justify-center hover:bg-warning-200 transition"
                                title="Edit">
                                <iconify-icon icon="solar:pen-outline" class="text-sm"></iconify-icon>
                            </a>
                            <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus slide ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 bg-danger-100 dark:bg-danger-600/25 text-danger-600 rounded-full flex items-center justify-center hover:bg-danger-200 transition"
                                    title="Hapus">
                                    <iconify-icon icon="solar:trash-bin-trash-outline" class="text-sm"></iconify-icon>
                                </button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth('admin')->user()->canManageSlides() ? 7 : 6 }}">
                        <div class="flex flex-col items-center justify-center py-16 px-4">
                            <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-primary-100 to-primary-50 dark:from-primary-600/15 dark:to-primary-600/5 flex items-center justify-center mb-5">
                                <iconify-icon icon="solar:gallery-minimalistic-bold-duotone" style="font-size: 48px;" class="text-primary-400 dark:text-primary-500"></iconify-icon>
                            </div>
                            @if (request('search'))
                            <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Tidak ada hasil</h6>
                            <p class="text-sm text-neutral-400 dark:text-neutral-500 text-center">Tidak ditemukan slide dengan kata kunci "{{ request('search') }}"</p>
                            @else
                            <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Belum ada data slide / banner</h6>
                            <p class="text-sm text-neutral-400 dark:text-neutral-500 mb-5 text-center">Mulai tambahkan slide untuk tampilan homepage.</p>
                            @if (auth('admin')->user()->canManageSlides())
                            <a href="{{ route('admin.slides.create') }}" class="inline-flex items-center gap-2 border border-primary-300 dark:border-primary-600 text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-600/10 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all">
                                <iconify-icon icon="solar:add-circle-bold" class="text-lg"></iconify-icon>
                                Tambah Slide Pertama
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
    @if ($slides->hasPages())
    <div class="px-5 py-4 border-t border-gray-100 dark:border-neutral-600 flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-neutral-400">
            Menampilkan {{ $slides->firstItem() }} - {{ $slides->lastItem() }} dari {{ $slides->total() }} slide
        </p>
        <div class="flex items-center gap-1">
            @if ($slides->onFirstPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-300 dark:text-neutral-600 cursor-not-allowed">
                <iconify-icon icon="solar:alt-arrow-left-outline" class="text-lg"></iconify-icon>
            </span>
            @else
            <a href="{{ $slides->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-neutral-400 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">
                <iconify-icon icon="solar:alt-arrow-left-outline" class="text-lg"></iconify-icon>
            </a>
            @endif

            @foreach ($slides->getUrlRange(1, $slides->lastPage()) as $page => $url)
            @if ($page == $slides->currentPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-semibold text-white" style="background-color: #df1995;">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-medium text-gray-600 dark:text-neutral-300 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">{{ $page }}</a>
            @endif
            @endforeach

            @if ($slides->hasMorePages())
            <a href="{{ $slides->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-neutral-400 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">
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
