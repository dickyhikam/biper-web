@extends('admin.layouts.app')

@section('title', 'Bidan / Terapis')
@section('page-title', 'Bidan / Terapis')
@section('breadcrumb', 'Bidan / Terapis')

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
                <h6 class="font-bold text-lg mb-0">Daftar Bidan / Terapis</h6>
                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-3 py-1 rounded-full text-xs font-semibold">
                    {{ $bidans->total() }} Bidan
                </span>
            </div>
            @if (auth('admin')->user()->canManageBidans())
            <a href="{{ route('admin.bidans.create') }}"
                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition">
                <iconify-icon icon="solar:add-circle-outline" class="text-lg"></iconify-icon>
                Tambah Bidan
            </a>
            @endif
        </div>

        {{-- Search & Per Page --}}
        <form method="GET" action="{{ route('admin.bidans.index') }}" class="flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2 flex-1" style="min-width: 200px; max-width: 420px;">
                <div class="relative flex-1">
                    <iconify-icon icon="solar:magnifer-linear" class="absolute top-1/2 -translate-y-1/2 text-gray-400 text-lg" style="left: 0.875rem;"></iconify-icon>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, spesialisasi, atau no. HP..."
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
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Foto</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Nama</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Spesialisasi</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">No HP</th>
                    <th class="px-5 py-3 text-left text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider">Status</th>
                    @if (auth('admin')->user()->canManageBidans())
                    <th class="px-5 py-3 text-center text-xs uppercase text-gray-500 dark:text-neutral-400 font-bold tracking-wider w-28">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-neutral-600 text-sm">
                @forelse ($bidans as $index => $bidan)
                <tr class="group hover:bg-gray-50/80 dark:hover:bg-neutral-600/50 transition-colors">
                    <td class="px-5 py-3 text-gray-500 dark:text-neutral-400">{{ $bidans->firstItem() + $index }}</td>
                    <td class="px-5 py-3">
                        @if ($bidan->user->photo_url)
                        <img src="{{ $bidan->user->photo_url }}" alt="{{ $bidan->user->name }}" class="w-10 h-10 rounded-full object-cover shrink-0">
                        @else
                        @php $nameParts = explode(' ', $bidan->user->name); $initials = strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : ''); @endphp
                        <div class="w-10 h-10 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-full flex justify-center items-center shrink-0 font-semibold text-xs">
                            {{ $initials }}
                        </div>
                        @endif
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center">
                            <div>
                                <span class="font-medium text-gray-800 dark:text-neutral-200">{{ $bidan->full_name }}</span>
                                @if ($bidan->str_number)
                                <br><span class="text-xs text-neutral-400">STR: {{ $bidan->str_number }}</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-gray-600 dark:text-neutral-300">{{ $bidan->specialization }}</td>
                    <td class="px-5 py-3 text-gray-600 dark:text-neutral-300">{{ $bidan->user->phone ?? '-' }}</td>
                    <td class="px-5 py-3">
                        @if (!$bidan->user->email_verified_at)
                        <span class="inline-flex items-center gap-1 bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-3 py-1 rounded-full text-xs font-medium">
                            <iconify-icon icon="solar:letter-unread-bold" class="text-sm"></iconify-icon>
                            Belum Verifikasi
                        </span>
                        @elseif ($bidan->is_active)
                        <span class="inline-flex items-center gap-1 bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-3 py-1 rounded-full text-xs font-medium">
                            <iconify-icon icon="solar:check-circle-bold" class="text-sm"></iconify-icon>
                            Aktif
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 px-3 py-1 rounded-full text-xs font-medium">
                            <iconify-icon icon="solar:close-circle-bold" class="text-sm"></iconify-icon>
                            Nonaktif
                        </span>
                        @endif
                    </td>
                    @if (auth('admin')->user()->canManageBidans())
                    <td class="px-5 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.bidans.show', $bidan) }}"
                                class="w-8 h-8 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-full flex items-center justify-center hover:bg-primary-200 transition"
                                title="Detail">
                                <iconify-icon icon="solar:eye-outline" class="text-sm"></iconify-icon>
                            </a>
                            <a href="{{ route('admin.bidans.edit', $bidan) }}"
                                class="w-8 h-8 bg-warning-100 dark:bg-warning-600/25 text-warning-600 rounded-full flex items-center justify-center hover:bg-warning-200 transition"
                                title="Edit">
                                <iconify-icon icon="solar:pen-outline" class="text-sm"></iconify-icon>
                            </a>
                            @if (!$bidan->user->email_verified_at)
                            <button type="button"
                                onclick="confirmResendInvitation({{ $bidan->id }}, '{{ addslashes($bidan->user->name) }}')"
                                class="w-8 h-8 bg-success-100 dark:bg-success-600/25 text-success-600 rounded-full flex items-center justify-center hover:bg-success-200 transition"
                                title="Kirim Ulang Email">
                                <iconify-icon icon="solar:letter-bold" class="text-sm"></iconify-icon>
                            </button>
                            @endif
                            <button type="button"
                                onclick="confirmDelete({{ $bidan->id }}, '{{ addslashes($bidan->user->name) }}')"
                                class="w-8 h-8 bg-danger-100 dark:bg-danger-600/25 text-danger-600 rounded-full flex items-center justify-center hover:bg-danger-200 transition"
                                title="Hapus">
                                <iconify-icon icon="solar:trash-bin-trash-outline" class="text-sm"></iconify-icon>
                            </button>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth('admin')->user()->canManageBidans() ? 6 : 5 }}">
                        <div class="flex flex-col items-center justify-center py-16 px-4">
                            <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-primary-100 to-primary-50 dark:from-primary-600/15 dark:to-primary-600/5 flex items-center justify-center mb-5">
                                <iconify-icon icon="solar:stethoscope-bold-duotone" style="font-size: 48px;" class="text-primary-400 dark:text-primary-500"></iconify-icon>
                            </div>
                            @if (request('search'))
                            <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Tidak ada hasil</h6>
                            <p class="text-sm text-neutral-400 dark:text-neutral-500 text-center">Tidak ditemukan bidan dengan kata kunci "{{ request('search') }}"</p>
                            @else
                            <h6 class="text-lg font-bold text-neutral-600 dark:text-neutral-300 mb-1">Belum ada data bidan / terapis</h6>
                            <p class="text-sm text-neutral-400 dark:text-neutral-500 mb-5 text-center">Mulai tambahkan data bidan untuk mengelola tim Anda.</p>
                            @if (auth('admin')->user()->canManageBidans())
                            <a href="{{ route('admin.bidans.create') }}" class="inline-flex items-center gap-2 border border-primary-300 dark:border-primary-600 text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-600/10 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all">
                                <iconify-icon icon="solar:add-circle-bold" class="text-lg"></iconify-icon>
                                Tambah Bidan Pertama
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
    @if ($bidans->hasPages())
    <div class="px-5 py-4 border-t border-gray-100 dark:border-neutral-600 flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-neutral-400">
            Menampilkan {{ $bidans->firstItem() }} - {{ $bidans->lastItem() }} dari {{ $bidans->total() }} bidan
        </p>
        <div class="flex items-center gap-1">
            @if ($bidans->onFirstPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-300 dark:text-neutral-600 cursor-not-allowed">
                <iconify-icon icon="solar:alt-arrow-left-outline" class="text-lg"></iconify-icon>
            </span>
            @else
            <a href="{{ $bidans->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-neutral-400 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">
                <iconify-icon icon="solar:alt-arrow-left-outline" class="text-lg"></iconify-icon>
            </a>
            @endif

            @foreach ($bidans->getUrlRange(1, $bidans->lastPage()) as $page => $url)
            @if ($page == $bidans->currentPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-semibold text-white" style="background-color: #df1995;">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-medium text-gray-600 dark:text-neutral-300 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">{{ $page }}</a>
            @endif
            @endforeach

            @if ($bidans->hasMorePages())
            <a href="{{ $bidans->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 dark:text-neutral-400 hover:bg-gray-100 dark:hover:bg-neutral-600 transition">
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

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function biperSwal(opts) {
        return Swal.fire(Object.assign({
            heightAuto: false,
            buttonsStyling: false,
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'biper-swal-btn biper-swal-confirm-primary',
                cancelButton: 'biper-swal-btn biper-swal-cancel'
            }
        }, opts));
    }

    function confirmDelete(bidanId, bidanName) {
        biperSwal({
            title: 'Hapus Bidan?',
            html: `Data bidan <strong>${bidanName}</strong> akan dihapus secara permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'biper-swal-btn biper-swal-confirm-danger',
                cancelButton: 'biper-swal-btn biper-swal-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/bidans/${bidanId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(res) {
                        biperSwal({
                            title: 'Berhasil!',
                            text: res.message,
                            icon: 'success',
                            timer: 2000,
                            timerProgressBar: true
                        }).then(() => location.reload());
                    },
                    error: function(xhr) {
                        biperSwal({
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }

    function confirmResendInvitation(bidanId, bidanName) {
        biperSwal({
            title: 'Kirim Ulang Email?',
            html: `Kirim ulang email undangan ke <strong>${bidanName}</strong> untuk membuat password.<br><small class="text-gray-400">Link sebelumnya akan diganti dengan yang baru (berlaku 24 jam).</small>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Kirim Ulang',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/bidans/${bidanId}/resend-invitation`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(res) {
                        biperSwal({
                            title: 'Berhasil!',
                            text: res.message,
                            icon: 'success',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function(xhr) {
                        biperSwal({
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }
</script>
@endpush