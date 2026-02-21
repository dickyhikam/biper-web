@extends('admin.layouts.app')

@section('title', 'Detail Pelanggan')
@section('page-title', 'Detail Pelanggan')
@section('breadcrumb', 'Detail Pelanggan')

@section('content')

    <div class="card biper-detail-card max-w-4xl">

        {{-- ====== Hero Profile Header ====== --}}
        <div class="biper-detail-hero">
            <div class="flex items-center justify-between mb-5">
                <div></div>
                <div class="biper-detail-actions">
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn--back">
                        <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="flex items-start gap-5">
                @php $nameParts = explode(' ', $pelanggan->name); $initials = strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : ''); @endphp
                <div class="biper-detail-hero__initials" style="background: linear-gradient(135deg, #fbcfe8, #f9a8d4); color: #be185d;">
                    {{ $initials }}
                </div>
                <div class="min-w-0">
                    <h2 class="biper-detail-hero__name">{{ $pelanggan->nickname }} {{ $pelanggan->name }}</h2>
                    <p class="biper-detail-hero__spec">
                        <iconify-icon icon="solar:letter-bold-duotone" class="text-primary-600"></iconify-icon>
                        {{ $pelanggan->email }}
                    </p>
                    <div class="biper-detail-hero__badges">
                        @if ($pelanggan->hasVerifiedEmail())
                            <span class="biper-badge biper-badge--active">
                                <iconify-icon icon="solar:check-circle-bold" class="text-sm"></iconify-icon>
                                Terverifikasi
                            </span>
                        @else
                            <span class="biper-badge biper-badge--inactive">
                                <iconify-icon icon="solar:clock-circle-bold" class="text-sm"></iconify-icon>
                                Belum Verifikasi
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ====== Info Stat Cards ====== --}}
        <div class="biper-detail-stats">
            <div class="biper-detail-stat">
                <div class="biper-detail-stat__icon biper-detail-stat__icon--pink">
                    <iconify-icon icon="solar:phone-calling-bold-duotone"></iconify-icon>
                </div>
                <div>
                    <div class="biper-detail-stat__label">WhatsApp</div>
                    <div class="biper-detail-stat__value {{ !$pelanggan->phone ? 'biper-detail-stat__value--muted' : '' }}">
                        {{ $pelanggan->phone ?? 'Belum diisi' }}
                    </div>
                </div>
            </div>
            <div class="biper-detail-stat">
                <div class="biper-detail-stat__icon biper-detail-stat__icon--cyan">
                    <iconify-icon icon="solar:baby-bold-duotone"></iconify-icon>
                </div>
                <div>
                    <div class="biper-detail-stat__label">Jumlah Anak</div>
                    <div class="biper-detail-stat__value">{{ $pelanggan->anaks->count() }} anak</div>
                </div>
            </div>
            <div class="biper-detail-stat">
                <div class="biper-detail-stat__icon biper-detail-stat__icon--amber">
                    <iconify-icon icon="solar:verified-check-bold-duotone"></iconify-icon>
                </div>
                <div>
                    <div class="biper-detail-stat__label">Email Terverifikasi</div>
                    <div class="biper-detail-stat__value {{ !$pelanggan->email_verified_at ? 'biper-detail-stat__value--muted' : '' }}">
                        {{ $pelanggan->email_verified_at ? $pelanggan->email_verified_at->format('d M Y, H:i') : 'Belum' }}
                    </div>
                </div>
            </div>
            <div class="biper-detail-stat">
                <div class="biper-detail-stat__icon biper-detail-stat__icon--purple">
                    <iconify-icon icon="solar:calendar-bold-duotone"></iconify-icon>
                </div>
                <div>
                    <div class="biper-detail-stat__label">Terdaftar Sejak</div>
                    <div class="biper-detail-stat__value">{{ $pelanggan->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
        </div>

        {{-- ====== Data Anak ====== --}}
        <div class="biper-detail-section">
            <div class="biper-detail-section__title">
                <iconify-icon icon="solar:baby-bold-duotone" class="text-base text-primary-600"></iconify-icon>
                Data Anak
            </div>

            @if ($pelanggan->anaks->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($pelanggan->anaks as $anak)
                        <div class="border border-neutral-200 dark:border-neutral-600 rounded-xl p-4 flex items-start gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0
                                {{ $anak->jenis_kelamin === 'L' ? 'bg-blue-100 dark:bg-blue-600/25 text-blue-600' : 'bg-pink-100 dark:bg-pink-600/25 text-pink-600' }}">
                                <iconify-icon icon="{{ $anak->jenis_kelamin === 'L' ? 'solar:men-bold-duotone' : 'solar:women-bold-duotone' }}" class="text-xl"></iconify-icon>
                            </div>
                            <div class="min-w-0">
                                <h6 class="font-semibold text-sm text-neutral-800 dark:text-neutral-200">{{ $anak->nama }}</h6>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1 text-xs text-neutral-500 dark:text-neutral-400">
                                    <span class="flex items-center gap-1">
                                        <iconify-icon icon="solar:calendar-outline" class="text-sm"></iconify-icon>
                                        {{ $anak->tanggal_lahir->format('d M Y') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <iconify-icon icon="solar:clock-circle-outline" class="text-sm"></iconify-icon>
                                        {{ $anak->usia_bulan }} bulan
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                                        {{ $anak->jenis_kelamin === 'L' ? 'bg-blue-100 dark:bg-blue-600/25 text-blue-600 dark:text-blue-400' : 'bg-pink-100 dark:bg-pink-600/25 text-pink-600 dark:text-pink-400' }}">
                                        {{ $anak->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-10 px-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-pink-100 to-pink-50 dark:from-pink-600/15 dark:to-pink-600/5 flex items-center justify-center mb-4">
                        <iconify-icon icon="solar:baby-bold-duotone" style="font-size: 32px;" class="text-pink-400 dark:text-pink-500"></iconify-icon>
                    </div>
                    <p class="text-sm text-neutral-400 dark:text-neutral-500 text-center">Pelanggan belum menambahkan data anak.</p>
                </div>
            @endif
        </div>

    </div>

@endsection
