@extends('admin.layouts.app')

@section('title', 'Tambah Bidan / Terapis')
@section('page-title', 'Tambah Bidan / Terapis')
@section('breadcrumb', 'Tambah Bidan / Terapis')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map { height: 300px; border-radius: 0.5rem; z-index: 1; }
    </style>
@endpush

@section('content')

    <div class="card border-0 rounded-lg max-w-4xl">
        <div class="card-body p-6">
            <h6 class="font-bold text-lg mb-4">Form Tambah Bidan / Terapis</h6>

            <form action="{{ route('admin.bidans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Informasi Dasar --}}
                <div class="mb-6">
                    <h6 class="font-semibold text-base mb-3 text-neutral-700 dark:text-neutral-300">Informasi Dasar</h6>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Akun User <span class="text-neutral-400 font-normal">(opsional)</span>
                            </label>
                            <select name="user_id" id="user_id"
                                    class="form-select w-full rounded-lg @error('user_id') border-danger-500 @enderror">
                                <option value="">-- Tidak Dikaitkan --</option>
                                @foreach ($availableUsers as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name') }}"
                                   class="form-control w-full rounded-lg @error('name') border-danger-500 @enderror"
                                   placeholder="Masukkan nama lengkap">
                            @error('name')
                                <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="credential" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Gelar / Credential <span class="text-neutral-400 font-normal">(opsional)</span>
                            </label>
                            <input type="text" name="credential" id="credential"
                                   value="{{ old('credential') }}"
                                   class="form-control w-full rounded-lg @error('credential') border-danger-500 @enderror"
                                   placeholder="cth: S.Tr.Keb, A.Md.Keb">
                            @error('credential')
                                <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="specialization" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Spesialisasi
                            </label>
                            <input type="text" name="specialization" id="specialization"
                                   value="{{ old('specialization') }}"
                                   class="form-control w-full rounded-lg @error('specialization') border-danger-500 @enderror"
                                   placeholder="cth: Baby Spa & Pijat Bayi">
                            @error('specialization')
                                <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                No HP <span class="text-neutral-400 font-normal">(opsional)</span>
                            </label>
                            <input type="text" name="phone" id="phone"
                                   value="{{ old('phone') }}"
                                   class="form-control w-full rounded-lg @error('phone') border-danger-500 @enderror"
                                   placeholder="cth: 081234567890">
                            @error('phone')
                                <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="str_number" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                No STR <span class="text-neutral-400 font-normal">(opsional)</span>
                            </label>
                            <input type="text" name="str_number" id="str_number"
                                   value="{{ old('str_number') }}"
                                   class="form-control w-full rounded-lg @error('str_number') border-danger-500 @enderror"
                                   placeholder="Nomor Surat Tanda Registrasi">
                            @error('str_number')
                                <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="experience_years" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Pengalaman (tahun)
                            </label>
                            <input type="number" name="experience_years" id="experience_years"
                                   value="{{ old('experience_years', 0) }}"
                                   class="form-control w-full rounded-lg @error('experience_years') border-danger-500 @enderror"
                                   min="0" max="50">
                            @error('experience_years')
                                <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2 mt-6">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                   class="form-check-input" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active" class="text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                Status Aktif
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Foto --}}
                <div class="mb-6">
                    <h6 class="font-semibold text-base mb-3 text-neutral-700 dark:text-neutral-300">Foto Profil</h6>
                    <div>
                        <label for="photo" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Upload Foto <span class="text-neutral-400 font-normal">(maks 2MB, format: JPG, PNG, WebP)</span>
                        </label>
                        <input type="file" name="photo" id="photo" accept="image/jpeg,image/png,image/webp"
                               class="form-control w-full rounded-lg @error('photo') border-danger-500 @enderror">
                        @error('photo')
                            <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div id="photo-preview" class="mt-2 hidden">
                            <img id="photo-preview-img" src="" alt="Preview" class="w-24 h-24 rounded-lg object-cover">
                        </div>
                    </div>
                </div>

                {{-- Bio --}}
                <div class="mb-6">
                    <h6 class="font-semibold text-base mb-3 text-neutral-700 dark:text-neutral-300">Biografi</h6>
                    <div>
                        <label for="bio" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Bio <span class="text-neutral-400 font-normal">(opsional)</span>
                        </label>
                        <textarea name="bio" id="bio" rows="3"
                                  class="form-control w-full rounded-lg @error('bio') border-danger-500 @enderror"
                                  placeholder="Deskripsi singkat tentang bidan/terapis">{{ old('bio') }}</textarea>
                        @error('bio')
                            <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Alamat & Lokasi --}}
                <div class="mb-6">
                    <h6 class="font-semibold text-base mb-3 text-neutral-700 dark:text-neutral-300">Alamat & Lokasi</h6>
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Alamat <span class="text-neutral-400 font-normal">(opsional)</span>
                        </label>
                        <textarea name="address" id="address" rows="2"
                                  class="form-control w-full rounded-lg @error('address') border-danger-500 @enderror"
                                  placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Latitude
                            </label>
                            <input type="text" name="latitude" id="latitude"
                                   value="{{ old('latitude') }}"
                                   class="form-control w-full rounded-lg @error('latitude') border-danger-500 @enderror"
                                   placeholder="-6.200000" readonly>
                            @error('latitude')
                                <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="longitude" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                Longitude
                            </label>
                            <input type="text" name="longitude" id="longitude"
                                   value="{{ old('longitude') }}"
                                   class="form-control w-full rounded-lg @error('longitude') border-danger-500 @enderror"
                                   placeholder="106.816666" readonly>
                            @error('longitude')
                                <p class="text-danger-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <p class="text-sm text-neutral-500 mb-2">Klik pada peta untuk menentukan lokasi:</p>
                    <div id="map"></div>
                </div>

                {{-- Jadwal Praktik --}}
                <div class="mb-6">
                    <h6 class="font-semibold text-base mb-3 text-neutral-700 dark:text-neutral-300">Jadwal Praktik</h6>
                    @php
                        $days = [
                            'monday' => 'Senin',
                            'tuesday' => 'Selasa',
                            'wednesday' => 'Rabu',
                            'thursday' => 'Kamis',
                            'friday' => 'Jumat',
                            'saturday' => 'Sabtu',
                            'sunday' => 'Minggu',
                        ];
                    @endphp
                    <div class="space-y-3">
                        @foreach ($days as $key => $label)
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="w-20 text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $label }}</span>
                                <input type="time" name="schedule[{{ $key }}][start]"
                                       value="{{ old("schedule.{$key}.start") }}"
                                       class="form-control rounded-lg text-sm w-32">
                                <span class="text-neutral-400">-</span>
                                <input type="time" name="schedule[{{ $key }}][end]"
                                       value="{{ old("schedule.{$key}.end") }}"
                                       class="form-control rounded-lg text-sm w-32">
                            </div>
                        @endforeach
                    </div>
                    <p class="text-sm text-neutral-400 mt-2">Kosongkan hari yang tidak ada jadwal praktik.</p>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                            class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                        <iconify-icon icon="solar:check-circle-outline" class="text-lg"></iconify-icon>
                        Simpan
                    </button>
                    <a href="{{ route('admin.bidans.index') }}"
                       class="bg-neutral-200 dark:bg-neutral-600 hover:bg-neutral-300 dark:hover:bg-neutral-500 text-neutral-700 dark:text-white px-6 py-2.5 rounded-lg font-medium transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Leaflet Map
        const defaultLat = -6.200000;
        const defaultLng = 106.816666;
        const initialLat = {{ old('latitude') ?: 'null' }};
        const initialLng = {{ old('longitude') ?: 'null' }};

        const map = L.map('map').setView(
            [initialLat || defaultLat, initialLng || defaultLng],
            initialLat ? 15 : 5
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = null;

        if (initialLat && initialLng) {
            marker = L.marker([initialLat, initialLng]).addTo(map);
        }

        map.on('click', function(e) {
            const { lat, lng } = e.latlng;
            document.getElementById('latitude').value = lat.toFixed(8);
            document.getElementById('longitude').value = lng.toFixed(8);

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        });

        // Photo Preview
        document.getElementById('photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('photo-preview');
            const previewImg = document.getElementById('photo-preview-img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>
@endpush
