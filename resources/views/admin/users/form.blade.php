@php
$isEdit = isset($user);
@endphp

@extends('admin.layouts.app')

@section('title', $isEdit ? 'Edit User' : 'Tambah User')
@section('page-title', $isEdit ? 'Edit User' : 'Tambah User')
@section('breadcrumb', $isEdit ? 'Edit User' : 'Tambah User')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')

<form action="{{ $isEdit ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    <div class="card biper-wizard-card">

        {{-- ====== Hero Header ====== --}}
        <div class="biper-wizard-header">
            <div class="flex flex-col sm:flex-row items-center gap-5">
                {{-- Photo Upload --}}
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="biper-photo-upload">
                        <div class="biper-photo-upload__preview" id="imagePreview"
                            style="background-image: url('{{ ($isEdit && $user->photo_url) ? $user->photo_url : asset('assets/images/user.png') }}');">
                        </div>
                        <label for="photo" class="biper-photo-upload__overlay">
                            <iconify-icon icon="solar:camera-bold" class="text-2xl"></iconify-icon>
                            <span class="text-xs mt-1">Ganti Foto</span>
                        </label>
                        <input type="file" id="photo" name="photo" accept=".png,.jpg,.jpeg,.webp" hidden>
                    </div>
                    @error('photo')
                    <p class="text-danger-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-neutral-400 mt-3">Maks 2MB &middot; JPG, PNG, WebP</p>
                </div>

                {{-- User Info --}}
                <div class="text-center sm:text-left min-w-0">
                    @if ($isEdit)
                        <h2 class="text-xl font-bold text-neutral-800 dark:text-neutral-200 mb-1">{{ $user->name }}</h2>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-3 flex items-center gap-1.5 justify-center sm:justify-start">
                            <iconify-icon icon="solar:letter-bold-duotone" class="text-base text-primary-600"></iconify-icon>
                            {{ $user->email }}
                        </p>
                        <div class="flex flex-wrap gap-2 justify-center sm:justify-start">
                            @php
                                $badgeColors = [
                                    'super_admin' => 'bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400',
                                    'owner' => 'bg-purple-100 dark:bg-purple-600/25 text-purple-600 dark:text-purple-400',
                                    'admin' => 'bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400',
                                    'bidan_terapis' => 'bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400',
                                ];
                            @endphp
                            <span class="{{ $badgeColors[$user->role] ?? '' }} px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $user->role_label }}
                            </span>
                            @if ($user->hasVerifiedEmail())
                            <span class="inline-flex items-center gap-1 bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-3 py-1 rounded-full text-xs font-semibold">
                                <iconify-icon icon="solar:check-circle-bold" class="text-sm"></iconify-icon>
                                Terverifikasi
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-3 py-1 rounded-full text-xs font-semibold">
                                <iconify-icon icon="solar:clock-circle-bold" class="text-sm"></iconify-icon>
                                Belum Verifikasi
                            </span>
                            @endif
                        </div>
                        <p class="text-xs text-neutral-400 mt-2">
                            <iconify-icon icon="solar:calendar-bold-duotone" class="text-sm align-middle"></iconify-icon>
                            Terdaftar {{ $user->created_at->format('d M Y') }}
                        </p>
                    @else
                        <h2 class="text-xl font-bold text-neutral-800 dark:text-neutral-200 mb-1">User Baru</h2>
                        <p class="text-sm text-neutral-400 dark:text-neutral-500 mb-3">Lengkapi data berikut untuk membuat user baru.</p>
                        <div class="inline-flex items-center gap-2 bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-3 py-1.5 rounded-lg text-xs">
                            <iconify-icon icon="solar:info-circle-bold-duotone" class="text-base"></iconify-icon>
                            User akan langsung aktif tanpa perlu verifikasi email.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ====== Form Body ====== --}}
        <div class="px-6 py-8 sm:px-8">

            {{-- Section: Data Pribadi --}}
            <div class="mb-8">
                <h6 class="font-bold text-sm mb-5 flex items-center gap-2 text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                    <iconify-icon icon="solar:user-id-bold-duotone" class="text-lg text-primary-600 normal-case"></iconify-icon>
                    Data Pribadi
                    <span class="flex-1 h-px bg-neutral-100 dark:bg-neutral-600"></span>
                </h6>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Nama Lengkap <span class="text-danger-600">*</span>
                        </label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="f7:person"></iconify-icon></span>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $isEdit ? $user->name : '') }}"
                                class="form-control @error('name') border-danger-500 @enderror"
                                placeholder="Masukkan nama lengkap" required>
                        </div>
                        @error('name')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Email <span class="text-danger-600">*</span>
                        </label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="solar:letter-linear"></iconify-icon></span>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $isEdit ? $user->email : '') }}"
                                class="form-control @error('email') border-danger-500 @enderror"
                                placeholder="Masukkan email" required>
                        </div>
                        @error('email')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            No HP <span class="text-neutral-400 font-normal">(opsional)</span>
                        </label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="solar:phone-calling-linear"></iconify-icon></span>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $isEdit ? $user->phone : '') }}"
                                class="form-control @error('phone') border-danger-500 @enderror"
                                placeholder="Contoh: 081234567890">
                        </div>
                        @error('phone')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="role" class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Role <span class="text-danger-600">*</span>
                        </label>
                        <select name="role" id="role"
                            class="form-select w-full @error('role') border-danger-500 @enderror" required>
                            @if (!$isEdit)
                            <option value="">-- Pilih Role --</option>
                            @endif
                            @foreach ($roles as $value => $label)
                            <option value="{{ $value }}" {{ old('role', $isEdit ? $user->role : '') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('role')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section: Password --}}
            <div class="mb-8">
                <h6 class="font-bold text-sm mb-5 flex items-center gap-2 text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                    <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="text-lg text-primary-600 normal-case"></iconify-icon>
                    {{ $isEdit ? 'Ubah Password' : 'Password' }}
                    <span class="flex-1 h-px bg-neutral-100 dark:bg-neutral-600"></span>
                </h6>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="password" class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Password
                            @if ($isEdit)
                            <span class="text-neutral-400 font-normal">(opsional)</span>
                            @else
                            <span class="text-danger-600">*</span>
                            @endif
                        </label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="solar:lock-keyhole-linear"></iconify-icon></span>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') border-danger-500 @enderror"
                                placeholder="{{ $isEdit ? 'Masukkan password baru' : 'Minimal 8 karakter' }}"
                                {{ $isEdit ? '' : 'required' }}>
                        </div>
                        @error('password')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Konfirmasi Password
                        </label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="solar:lock-keyhole-linear"></iconify-icon></span>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control"
                                placeholder="{{ $isEdit ? 'Ulangi password baru' : 'Ulangi password' }}">
                        </div>
                    </div>
                </div>

                @if ($isEdit)
                <p class="text-xs text-neutral-400 dark:text-neutral-500 mt-3 flex items-start gap-2">
                    <iconify-icon icon="solar:info-circle-outline" class="text-sm mt-0.5 shrink-0"></iconify-icon>
                    Kosongkan password jika tidak ingin mengubahnya.
                </p>
                @endif
            </div>

            {{-- Section: Alamat & Lokasi --}}
            <div class="mb-8">
                <h6 class="font-bold text-sm mb-5 flex items-center gap-2 text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">
                    <iconify-icon icon="solar:map-point-bold-duotone" class="text-lg text-primary-600 normal-case"></iconify-icon>
                    Alamat & Lokasi
                    <span class="flex-1 h-px bg-neutral-100 dark:bg-neutral-600"></span>
                </h6>

                <div class="space-y-5">
                    <div>
                        <label for="address" class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Alamat Lengkap
                        </label>
                        <textarea name="address" id="address" rows="2"
                            class="form-control @error('address') border-danger-500 @enderror"
                            placeholder="Masukkan alamat lengkap">{{ old('address', $isEdit ? $user->address : '') }}</textarea>
                        @error('address')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="biper-map-container">
                            <div class="biper-map-hint">
                                <iconify-icon icon="solar:map-arrow-right-bold" class="text-primary-600 text-lg"></iconify-icon>
                                <span>Klik pada peta atau cari lokasi untuk menentukan titik</span>
                            </div>
                            <div style="position:relative;">
                                {{-- Search overlay di dalam peta --}}
                                <div class="biper-map-search">
                                    <div class="biper-map-search__input">
                                        <iconify-icon icon="solar:magnifer-linear" class="text-neutral-400 text-lg"></iconify-icon>
                                        <input type="text" id="mapSearch" placeholder="Cari lokasi..." autocomplete="off">
                                    </div>
                                    <div id="mapSearchResults" class="biper-map-search__results" style="display:none;"></div>
                                </div>
                                <div id="map" style="height: 350px;"></div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3 mt-3">
                            <div class="biper-coord-badge">
                                <iconify-icon icon="solar:routing-2-outline" class="text-primary-600"></iconify-icon>
                                <span class="text-neutral-500 text-xs">Lat:</span>
                                <input type="text" name="latitude" id="latitude"
                                    value="{{ old('latitude', $isEdit ? $user->latitude : '') }}"
                                    class="biper-coord-input" placeholder="&mdash;" readonly>
                            </div>
                            <div class="biper-coord-badge">
                                <iconify-icon icon="solar:routing-2-outline" class="text-primary-600"></iconify-icon>
                                <span class="text-neutral-500 text-xs">Lng:</span>
                                <input type="text" name="longitude" id="longitude"
                                    value="{{ old('longitude', $isEdit ? $user->longitude : '') }}"
                                    class="biper-coord-input" placeholder="&mdash;" readonly>
                            </div>
                        </div>
                        @error('latitude')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        @error('longitude')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        {{-- ====== Footer Actions ====== --}}
        <div class="biper-wizard-nav">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-neutral">
                <iconify-icon icon="solar:arrow-left-linear" class="text-lg"></iconify-icon>
                Batal
            </a>
            <button type="submit" class="btn btn-primary-600 biper-wizard-btn-submit">
                <iconify-icon icon="{{ $isEdit ? 'solar:pen-bold' : 'solar:check-circle-bold' }}" class="text-lg"></iconify-icon>
                {{ $isEdit ? 'Perbarui Data' : 'Simpan Data' }}
            </button>
        </div>

    </div>
</form>

@endsection

@php
$mapLat = old('latitude', ($isEdit && $user->latitude) ? $user->latitude : null);
$mapLng = old('longitude', ($isEdit && $user->longitude) ? $user->longitude : null);
@endphp

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<div id="mapData" data-lat="{{ $mapLat ?? '' }}" data-lng="{{ $mapLng ?? '' }}" style="display:none;"></div>
<script>
    $(function() {
        // Photo Upload Preview
        document.getElementById('photo').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('imagePreview').style.backgroundImage = 'url(' + ev.target.result + ')';
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Leaflet Map — default Sidoarjo
        var defaultLat = -7.447800;
        var defaultLng = 112.718300;
        var mapData = document.getElementById('mapData');
        var initialLat = mapData.dataset.lat ? parseFloat(mapData.dataset.lat) : null;
        var initialLng = mapData.dataset.lng ? parseFloat(mapData.dataset.lng) : null;

        var map = L.map('map').setView(
            [initialLat || defaultLat, initialLng || defaultLng],
            initialLat ? 16 : 13
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        var marker = null;

        if (initialLat && initialLng) {
            marker = L.marker([initialLat, initialLng]).addTo(map);
        }

        // Helper: set marker + coordinates
        function setLocation(lat, lng, zoomLevel) {
            document.getElementById('latitude').value = lat.toFixed(8);
            document.getElementById('longitude').value = lng.toFixed(8);
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }
            if (zoomLevel) map.setView([lat, lng], zoomLevel);
        }

        // Reverse geocoding: klik peta → isi alamat
        map.on('click', function(e) {
            setLocation(e.latlng.lat, e.latlng.lng);

            fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + e.latlng.lat + '&lon=' + e.latlng.lng + '&zoom=18&addressdetails=1', {
                headers: { 'Accept-Language': 'id' }
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.display_name) {
                    document.getElementById('address').value = data.display_name;
                }
            })
            .catch(function() {});
        });

        // Forward geocoding: cari alamat → tampilkan di peta
        var searchTimeout;
        var $search = $('#mapSearch');
        var $results = $('#mapSearchResults');

        $search.on('input', function() {
            var query = $(this).val().trim();
            clearTimeout(searchTimeout);

            if (query.length < 3) {
                $results.hide().empty();
                return;
            }

            searchTimeout = setTimeout(function() {
                fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(query) + '&countrycodes=id&limit=5&addressdetails=1', {
                    headers: { 'Accept-Language': 'id' }
                })
                .then(function(r) { return r.json(); })
                .then(function(items) {
                    $results.empty();
                    if (items.length === 0) {
                        $results.append('<div class="biper-search-empty">Tidak ditemukan</div>');
                    } else {
                        items.forEach(function(item) {
                            $results.append(
                                '<div class="biper-search-item" data-lat="' + item.lat + '" data-lng="' + item.lon + '">' +
                                '<div class="font-medium">' + item.display_name + '</div>' +
                                '</div>'
                            );
                        });
                    }
                    $results.show();
                })
                .catch(function() {});
            }, 400);
        });

        // Klik hasil search
        $(document).on('click', '.biper-search-item', function() {
            var lat = parseFloat($(this).data('lat'));
            var lng = parseFloat($(this).data('lng'));
            var name = $(this).find('div').text();

            setLocation(lat, lng, 16);
            document.getElementById('address').value = name;

            $results.hide().empty();
            $search.val('');
        });

        // Tutup dropdown saat klik di luar
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#mapSearch, #mapSearchResults').length) {
                $results.hide();
            }
        });

        // Enter key pada search → cari langsung
        $search.on('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
