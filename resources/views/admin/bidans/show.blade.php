@extends('admin.layouts.app')

@section('title', 'Detail Bidan / Terapis')
@section('page-title', 'Detail Bidan / Terapis')
@section('breadcrumb', 'Detail Bidan / Terapis')

@push('styles')
    @if ($bidan->latitude && $bidan->longitude)
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            #map { height: 300px; border-radius: 0.5rem; z-index: 1; }
        </style>
    @endif
@endpush

@section('content')

    <div class="card border-0 rounded-lg max-w-4xl">
        <div class="card-body p-6">
            <div class="flex items-center justify-between mb-6">
                <h6 class="font-bold text-lg mb-0">Detail Bidan / Terapis</h6>
                <div class="flex items-center gap-2">
                    @if (auth('admin')->user()->canManageBidans())
                        <a href="{{ route('admin.bidans.edit', $bidan) }}"
                           class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition hover:bg-warning-200">
                            <iconify-icon icon="solar:pen-outline" class="text-lg"></iconify-icon>
                            Edit
                        </a>
                    @endif
                    <a href="{{ route('admin.bidans.index') }}"
                       class="bg-neutral-200 dark:bg-neutral-600 hover:bg-neutral-300 dark:hover:bg-neutral-500 text-neutral-700 dark:text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        Kembali
                    </a>
                </div>
            </div>

            {{-- Profil Header --}}
            <div class="flex items-start gap-4 mb-6 pb-6 border-b border-neutral-200 dark:border-neutral-600">
                @if ($bidan->photo_url)
                    <img src="{{ $bidan->photo_url }}" alt="{{ $bidan->name }}"
                         class="w-24 h-24 rounded-lg object-cover shrink-0">
                @else
                    <div class="w-24 h-24 bg-primary-100 dark:bg-primary-600/25 text-primary-600 rounded-lg flex justify-center items-center font-bold text-2xl shrink-0">
                        {{ strtoupper(substr($bidan->name, 0, 2)) }}
                    </div>
                @endif
                <div>
                    <h5 class="font-bold text-xl mb-1">{{ $bidan->full_name }}</h5>
                    <p class="text-neutral-500 mb-2">{{ $bidan->specialization }}</p>
                    @if ($bidan->is_active)
                        <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                    @else
                        <span class="bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 px-3 py-1 rounded-full text-xs font-medium">Nonaktif</span>
                    @endif
                </div>
            </div>

            {{-- Info Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <span class="text-sm text-neutral-500">No HP</span>
                    <p class="font-medium">{{ $bidan->phone ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-sm text-neutral-500">No STR</span>
                    <p class="font-medium">{{ $bidan->str_number ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-sm text-neutral-500">Pengalaman</span>
                    <p class="font-medium">{{ $bidan->experience_years }} tahun</p>
                </div>
                <div>
                    <span class="text-sm text-neutral-500">Akun User</span>
                    <p class="font-medium">{{ $bidan->user ? $bidan->user->email : 'Tidak dikaitkan' }}</p>
                </div>
            </div>

            {{-- Bio --}}
            @if ($bidan->bio)
                <div class="mb-6">
                    <h6 class="font-semibold text-base mb-2 text-neutral-700 dark:text-neutral-300">Biografi</h6>
                    <p class="text-neutral-600 dark:text-neutral-400">{{ $bidan->bio }}</p>
                </div>
            @endif

            {{-- Alamat & Peta --}}
            @if ($bidan->address || ($bidan->latitude && $bidan->longitude))
                <div class="mb-6">
                    <h6 class="font-semibold text-base mb-2 text-neutral-700 dark:text-neutral-300">Alamat & Lokasi</h6>
                    @if ($bidan->address)
                        <p class="text-neutral-600 dark:text-neutral-400 mb-3">{{ $bidan->address }}</p>
                    @endif
                    @if ($bidan->latitude && $bidan->longitude)
                        <div id="map"></div>
                        <p class="text-xs text-neutral-400 mt-2">Koordinat: {{ $bidan->latitude }}, {{ $bidan->longitude }}</p>
                    @endif
                </div>
            @endif

            {{-- Jadwal Praktik --}}
            @if ($bidan->schedule && count($bidan->schedule) > 0)
                <div class="mb-6">
                    <h6 class="font-semibold text-base mb-2 text-neutral-700 dark:text-neutral-300">Jadwal Praktik</h6>
                    @php
                        $dayLabels = [
                            'monday' => 'Senin',
                            'tuesday' => 'Selasa',
                            'wednesday' => 'Rabu',
                            'thursday' => 'Kamis',
                            'friday' => 'Jumat',
                            'saturday' => 'Sabtu',
                            'sunday' => 'Minggu',
                        ];
                    @endphp
                    <div class="space-y-2">
                        @foreach ($dayLabels as $key => $label)
                            @if (isset($bidan->schedule[$key]))
                                <div class="flex items-center gap-3">
                                    <span class="w-20 text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $label }}</span>
                                    <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                        {{ $bidan->schedule[$key]['start'] }} - {{ $bidan->schedule[$key]['end'] }}
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
    @if ($bidan->latitude && $bidan->longitude)
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            const map = L.map('map').setView([{{ $bidan->latitude }}, {{ $bidan->longitude }}], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            L.marker([{{ $bidan->latitude }}, {{ $bidan->longitude }}]).addTo(map)
                .bindPopup('{{ $bidan->full_name }}').openPopup();
        </script>
    @endif
@endpush
