@extends('admin.layouts.app')

@section('title', 'Detail Bidan / Terapis')
@section('page-title', 'Detail Bidan / Terapis')
@section('breadcrumb', 'Detail Bidan / Terapis')

@push('styles')
    @if ($bidan->user->latitude && $bidan->user->longitude)
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endif
@endpush

@section('content')

    <div class="card biper-detail-card max-w-4xl">

        {{-- ====== Hero Profile Header ====== --}}
        <div class="biper-detail-hero">
            <div class="flex items-center justify-between mb-5">
                <div></div>
                <div class="biper-detail-actions">
                    @if (auth('admin')->user()->canManageBidans())
                        <a href="{{ route('admin.bidans.edit', $bidan) }}" class="btn btn--edit">
                            <iconify-icon icon="solar:pen-bold-duotone" class="text-lg"></iconify-icon>
                            Edit
                        </a>
                    @endif
                    <a href="{{ route('admin.bidans.index') }}" class="btn btn--back">
                        <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="flex items-start gap-5">
                @if ($bidan->user->photo_url)
                    <img src="{{ $bidan->user->photo_url }}" alt="{{ $bidan->user->name }}" class="biper-detail-hero__avatar">
                @else
                    @php $nameParts = explode(' ', $bidan->user->name); $initials = strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : ''); @endphp
                    <div class="biper-detail-hero__initials">
                        {{ $initials }}
                    </div>
                @endif
                <div class="min-w-0">
                    <h2 class="biper-detail-hero__name">{{ $bidan->full_name }}</h2>
                    <p class="biper-detail-hero__spec">
                        <iconify-icon icon="solar:stethoscope-bold-duotone" class="text-primary-600"></iconify-icon>
                        {{ $bidan->specialization }}
                    </p>
                    <div class="biper-detail-hero__badges">
                        @if ($bidan->is_active)
                            <span class="biper-badge biper-badge--active">
                                <iconify-icon icon="solar:check-circle-bold" class="text-sm"></iconify-icon>
                                Aktif
                            </span>
                        @else
                            <span class="biper-badge biper-badge--inactive">
                                <iconify-icon icon="solar:close-circle-bold" class="text-sm"></iconify-icon>
                                Nonaktif
                            </span>
                        @endif
                        @if ($bidan->employment_type === 'fulltime')
                            <span class="biper-badge biper-badge--fulltime">
                                <iconify-icon icon="solar:buildings-bold-duotone" class="text-sm"></iconify-icon>
                                Fulltime
                            </span>
                        @else
                            <span class="biper-badge biper-badge--freelance">
                                <iconify-icon icon="solar:user-hand-up-bold-duotone" class="text-sm"></iconify-icon>
                                Freelance
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
                    <div class="biper-detail-stat__label">No HP</div>
                    <div class="biper-detail-stat__value {{ !$bidan->user->phone ? 'biper-detail-stat__value--muted' : '' }}">
                        {{ $bidan->user->phone ?? 'Belum diisi' }}
                    </div>
                </div>
            </div>
            <div class="biper-detail-stat">
                <div class="biper-detail-stat__icon biper-detail-stat__icon--cyan">
                    <iconify-icon icon="solar:document-text-bold-duotone"></iconify-icon>
                </div>
                <div>
                    <div class="biper-detail-stat__label">No STR</div>
                    <div class="biper-detail-stat__value {{ !$bidan->str_number ? 'biper-detail-stat__value--muted' : '' }}">
                        {{ $bidan->str_number ?? 'Belum diisi' }}
                    </div>
                </div>
            </div>
            <div class="biper-detail-stat">
                <div class="biper-detail-stat__icon biper-detail-stat__icon--amber">
                    <iconify-icon icon="solar:medal-ribbons-star-bold-duotone"></iconify-icon>
                </div>
                <div>
                    <div class="biper-detail-stat__label">Pengalaman</div>
                    <div class="biper-detail-stat__value">{{ $bidan->experience_years }} tahun</div>
                </div>
            </div>
            <div class="biper-detail-stat">
                <div class="biper-detail-stat__icon biper-detail-stat__icon--purple">
                    <iconify-icon icon="solar:user-circle-bold-duotone"></iconify-icon>
                </div>
                <div>
                    <div class="biper-detail-stat__label">Akun User</div>
                    <div class="biper-detail-stat__value {{ !$bidan->user ? 'biper-detail-stat__value--muted' : '' }}">
                        {{ $bidan->user ? $bidan->user->email : 'Tidak dikaitkan' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- ====== Bio ====== --}}
        @if ($bidan->bio)
            <div class="biper-detail-section">
                <div class="biper-detail-section__title">
                    <iconify-icon icon="solar:notebook-bold-duotone" class="text-base text-primary-600"></iconify-icon>
                    Biografi
                </div>
                <div class="biper-detail-bio">{{ $bidan->bio }}</div>
            </div>
        @endif

        {{-- ====== Jadwal Praktik ====== --}}
        @php
            $allDays = [
                'monday' => 'Sen',
                'tuesday' => 'Sel',
                'wednesday' => 'Rab',
                'thursday' => 'Kam',
                'friday' => 'Jum',
                'saturday' => 'Sab',
                'sunday' => 'Min',
            ];
        @endphp
        <div class="biper-detail-section">
            <div class="biper-detail-section__title">
                <iconify-icon icon="solar:clock-circle-bold-duotone" class="text-base text-primary-600"></iconify-icon>
                Jadwal Praktik
            </div>
            <div class="biper-detail-schedule">
                @foreach ($allDays as $key => $label)
                    @php $hasDay = $bidan->schedule && isset($bidan->schedule[$key]); @endphp
                    <div class="biper-detail-schedule__day {{ $hasDay ? 'is-active' : '' }}">
                        <div class="biper-detail-schedule__head">{{ $label }}</div>
                        <div class="biper-detail-schedule__time">
                            @if ($hasDay)
                                {{ $bidan->schedule[$key]['start'] }}<br>{{ $bidan->schedule[$key]['end'] }}
                            @else
                                <iconify-icon icon="solar:moon-sleep-bold-duotone" class="text-base"></iconify-icon>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ====== Alamat & Peta ====== --}}
        @if ($bidan->user->address || ($bidan->user->latitude && $bidan->user->longitude))
            <div class="biper-detail-section">
                <div class="biper-detail-section__title">
                    <iconify-icon icon="solar:map-point-bold-duotone" class="text-base text-primary-600"></iconify-icon>
                    Alamat & Lokasi
                </div>
                @if ($bidan->user->address)
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3 flex items-start gap-2">
                        <iconify-icon icon="solar:map-arrow-right-bold" class="text-primary-600 text-base mt-0.5 flex-shrink-0"></iconify-icon>
                        {{ $bidan->user->address }}
                    </p>
                @endif
                @if ($bidan->user->latitude && $bidan->user->longitude)
                    <div class="biper-detail-map">
                        <div id="map"></div>
                    </div>
                    <div class="flex flex-wrap gap-3 mt-3">
                        <div class="biper-coord-badge">
                            <iconify-icon icon="solar:routing-2-outline" class="text-primary-600"></iconify-icon>
                            <span class="text-neutral-500 text-xs">Lat:</span>
                            <span class="text-xs font-medium text-neutral-700 dark:text-neutral-300">{{ $bidan->user->latitude }}</span>
                        </div>
                        <div class="biper-coord-badge">
                            <iconify-icon icon="solar:routing-2-outline" class="text-primary-600"></iconify-icon>
                            <span class="text-neutral-500 text-xs">Lng:</span>
                            <span class="text-xs font-medium text-neutral-700 dark:text-neutral-300">{{ $bidan->user->longitude }}</span>
                        </div>
                    </div>
                @endif
            </div>
        @endif

    </div>

@endsection

@php
    $showLat = ($bidan->user->latitude && $bidan->user->longitude) ? $bidan->user->latitude : null;
    $showLng = ($bidan->user->latitude && $bidan->user->longitude) ? $bidan->user->longitude : null;
@endphp

@push('scripts')
    @if ($showLat && $showLng)
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <div id="showMapData" data-lat="{{ $showLat }}" data-lng="{{ $showLng }}" data-name="{{ $bidan->full_name }}" style="display:none;"></div>
        <script>
            var md = document.getElementById('showMapData');
            var lat = parseFloat(md.dataset.lat);
            var lng = parseFloat(md.dataset.lng);
            var name = md.dataset.name;

            var map = L.map('map').setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map).bindPopup(name).openPopup();
        </script>
    @endif
@endpush
