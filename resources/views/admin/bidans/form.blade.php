@php
$isEdit = isset($bidan);
@endphp

@extends('admin.layouts.app')

@section('title', $isEdit ? 'Edit Bidan / Terapis' : 'Tambah Bidan / Terapis')
@section('page-title', $isEdit ? 'Edit Bidan / Terapis' : 'Tambah Bidan / Terapis')
@section('breadcrumb', $isEdit ? 'Edit Bidan / Terapis' : 'Tambah Bidan / Terapis')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')

<div class="card biper-wizard-card">

    {{-- ====== Step Indicator Header ====== --}}
    <div class="biper-wizard-header">
        <p class="text-sm text-neutral-400 text-center mb-6">Lengkapi data di setiap langkah berikut</p>

        <div class="biper-wizard-steps" id="wizardSteps">
            <div class="biper-wizard-step active" data-step="0">
                <div class="biper-wizard-step__icon">
                    <iconify-icon icon="solar:user-id-bold-duotone"></iconify-icon>
                </div>
                <span class="biper-wizard-step__label">Profil</span>
            </div>
            <div class="biper-wizard-step__connector">
                <div class="biper-wizard-step__connector-fill"></div>
            </div>
            <div class="biper-wizard-step" data-step="1">
                <div class="biper-wizard-step__icon">
                    <iconify-icon icon="solar:diploma-verified-bold-duotone"></iconify-icon>
                </div>
                <span class="biper-wizard-step__label">Keahlian</span>
            </div>
            <div class="biper-wizard-step__connector">
                <div class="biper-wizard-step__connector-fill"></div>
            </div>
            <div class="biper-wizard-step" data-step="2">
                <div class="biper-wizard-step__icon">
                    <iconify-icon icon="solar:notebook-bold-duotone"></iconify-icon>
                </div>
                <span class="biper-wizard-step__label">Detail</span>
            </div>
            <div class="biper-wizard-step__connector">
                <div class="biper-wizard-step__connector-fill"></div>
            </div>
            <div class="biper-wizard-step" data-step="3">
                <div class="biper-wizard-step__icon">
                    <iconify-icon icon="solar:map-point-bold-duotone"></iconify-icon>
                </div>
                <span class="biper-wizard-step__label">Lokasi</span>
            </div>
            <div class="biper-wizard-step__connector">
                <div class="biper-wizard-step__connector-fill"></div>
            </div>
            <div class="biper-wizard-step" data-step="4">
                <div class="biper-wizard-step__icon">
                    <iconify-icon icon="solar:clock-circle-bold-duotone"></iconify-icon>
                </div>
                <span class="biper-wizard-step__label">Jadwal</span>
            </div>
        </div>
    </div>

    {{-- ====== Form ====== --}}
    <form action="{{ $isEdit ? route('admin.bidans.update', $bidan) : route('admin.bidans.store') }}"
        method="POST" enctype="multipart/form-data" id="bidanForm">
        @csrf
        @if ($isEdit) @method('PUT') @endif

        {{-- ========== Step 1: Profil & Foto ========== --}}
        <div class="biper-wizard-panel active" data-panel="0">
            <div class="px-6 py-8 sm:px-8">


                {{-- Photo Upload --}}
                <div class="flex flex-col items-center mb-8">
                    <div class="biper-photo-upload">
                        <div class="biper-photo-upload__preview" id="imagePreview"
                            style="background-image: url('{{ ($isEdit && $bidan->photo_url) ? $bidan->photo_url : asset('assets/images/user.png') }}');">
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

                {{-- Link User Account --}}
                <div class="biper-link-account-box mb-8">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-full bg-primary-50 dark:bg-primary-600/20 flex items-center justify-center flex-shrink-0">
                            <iconify-icon icon="solar:link-round-bold" class="text-primary-600 text-lg"></iconify-icon>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-neutral-700 dark:text-neutral-200 mb-0">Hubungkan Akun User</p>
                            <p class="text-xs text-neutral-400 mb-0">Pilih akun user yang sudah ada, atau kosongkan untuk membuat profil baru.</p>
                        </div>
                    </div>
                    <select name="user_id" id="userSelect" class="form-control form-select @error('user_id') border-danger-500 @enderror">
                        <option value="new" {{ old('user_id', $isEdit ? $bidan->user_id : 'new') == 'new' ? 'selected' : '' }}>-- Buat Akun Baru --</option>
                        @foreach ($availableUsers as $user)
                        <option value="{{ $user->id }}" data-name="{{ $user->name }}"
                            {{ old('user_id', $isEdit ? $bidan->user_id : '') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    {{-- Linked user info --}}
                    <div id="linkedUserInfo" class="biper-linked-info mt-2" style="display: none;">
                        <iconify-icon icon="solar:check-circle-bold" class="text-success-600"></iconify-icon>
                        <span>Nama otomatis diisi dari akun user. Anda tetap bisa mengubahnya.</span>
                    </div>

                    {{-- New account fields --}}
                    <div id="newAccountFields" class="mt-4 pt-4 border-top border-neutral-200 dark:border-neutral-600" style="display: none;">
                        <p class="text-xs font-semibold text-neutral-500 dark:text-neutral-400 mb-3 flex items-center gap-1">
                            <iconify-icon icon="solar:shield-user-bold" class="text-sm text-primary-600"></iconify-icon>
                            Data Akun Login
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label text-sm text-neutral-600 dark:text-neutral-300 mb-1">Email <span class="text-danger-600">*</span></label>
                                <div class="icon-field">
                                    <span class="icon"><iconify-icon icon="solar:letter-linear"></iconify-icon></span>
                                    <input type="email" name="email" id="newEmail"
                                        value="{{ old('email') }}"
                                        class="form-control @error('email') border-danger-500 @enderror"
                                        placeholder="Email untuk login">
                                </div>
                                @error('email')
                                <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="form-label text-sm text-neutral-600 dark:text-neutral-300 mb-1">Password <span class="text-danger-600">*</span></label>
                                <div class="icon-field">
                                    <span class="icon"><iconify-icon icon="solar:lock-keyhole-linear"></iconify-icon></span>
                                    <input type="password" name="password" id="newPassword"
                                        class="form-control @error('password') border-danger-500 @enderror"
                                        placeholder="Minimal 8 karakter">
                                </div>
                                @error('password')
                                <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Profile Fields --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Nama Lengkap <span class="text-danger-600">*</span>
                        </label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="f7:person"></iconify-icon></span>
                            <input type="text" name="name" value="{{ old('name', $isEdit ? $bidan->name : '') }}"
                                class="form-control @error('name') border-danger-500 @enderror"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Status
                        </label>
                        <div class="flex items-center gap-3 h-[44px]">
                            <input type="hidden" name="is_active" value="0">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                    {{ old('is_active', $isEdit ? $bidan->is_active : true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-neutral-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 rounded-full peer dark:bg-neutral-600 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                            </label>
                            <span class="text-sm font-medium text-neutral-600 dark:text-neutral-300">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 1 Navigation --}}
            <div class="biper-wizard-nav">
                <div></div>
                <button type="button" class="btn btn-primary-600 biper-wizard-btn-next">
                    Selanjutnya
                    <iconify-icon icon="solar:arrow-right-linear" class="text-lg"></iconify-icon>
                </button>
            </div>
        </div>

        {{-- ========== Step 2: Keahlian ========== --}}
        <div class="biper-wizard-panel" data-panel="1">
            <div class="px-6 py-8 sm:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Gelar / Credential
                        </label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="solar:diploma-outline"></iconify-icon></span>
                            <input type="text" name="credential" value="{{ old('credential', $isEdit ? $bidan->credential : '') }}"
                                class="form-control @error('credential') border-danger-500 @enderror"
                                placeholder="cth: S.Tr.Keb, A.Md.Keb">
                        </div>
                        @error('credential')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Spesialisasi <span class="text-danger-600">*</span>
                        </label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="solar:stethoscope-outline"></iconify-icon></span>
                            <input type="text" name="specialization" value="{{ old('specialization', $isEdit ? $bidan->specialization : '') }}"
                                class="form-control @error('specialization') border-danger-500 @enderror"
                                placeholder="cth: Baby Spa & Pijat Bayi">
                        </div>
                        @error('specialization')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Tipe Pekerjaan <span class="text-danger-600">*</span>
                        </label>
                        <br>
                        <div class="biper-pill-toggle">
                            <label class="biper-pill-toggle__option">
                                <input type="radio" name="employment_type" value="fulltime" class="sr-only peer"
                                    {{ old('employment_type', $isEdit ? $bidan->employment_type : 'fulltime') === 'fulltime' ? 'checked' : '' }}>
                                <div class="biper-pill-toggle__label">
                                    <iconify-icon icon="solar:buildings-bold-duotone" class="text-lg"></iconify-icon>
                                    <span>Fulltime</span>
                                </div>
                            </label>
                            <label class="biper-pill-toggle__option">
                                <input type="radio" name="employment_type" value="freelance" class="sr-only peer"
                                    {{ old('employment_type', $isEdit ? $bidan->employment_type : 'fulltime') === 'freelance' ? 'checked' : '' }}>
                                <div class="biper-pill-toggle__label">
                                    <iconify-icon icon="solar:user-hand-up-bold-duotone" class="text-lg"></iconify-icon>
                                    <span>Freelance</span>
                                </div>
                            </label>
                        </div>
                        @error('employment_type')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">No STR</label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="solar:document-text-outline"></iconify-icon></span>
                            <input type="text" name="str_number" value="{{ old('str_number', $isEdit ? $bidan->str_number : '') }}"
                                class="form-control @error('str_number') border-danger-500 @enderror"
                                placeholder="Nomor Surat Tanda Registrasi">
                        </div>
                        @error('str_number')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                            Pengalaman <span class="text-danger-600">*</span>
                        </label>
                        <div class="biper-exp-stepper">
                            <button type="button" class="biper-exp-stepper__btn" id="expMinus">
                                <iconify-icon icon="solar:minus-circle-bold" class="text-xl"></iconify-icon>
                            </button>
                            <div class="biper-exp-stepper__display">
                                <span class="biper-exp-stepper__value" id="expValue">{{ old('experience_years', $isEdit ? $bidan->experience_years : 0) }}</span>
                                <span class="biper-exp-stepper__unit">tahun</span>
                            </div>
                            <button type="button" class="biper-exp-stepper__btn biper-exp-stepper__btn--plus" id="expPlus">
                                <iconify-icon icon="solar:add-circle-bold" class="text-xl"></iconify-icon>
                            </button>
                            <input type="hidden" name="experience_years" id="expInput"
                                value="{{ old('experience_years', $isEdit ? $bidan->experience_years : 0) }}">
                        </div>
                        @error('experience_years')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Step 2 Navigation --}}
            <div class="biper-wizard-nav">
                <button type="button" class="btn btn-outline-neutral biper-wizard-btn-prev">
                    <iconify-icon icon="solar:arrow-left-linear" class="text-lg"></iconify-icon>
                    Kembali
                </button>
                <button type="button" class="btn btn-primary-600 biper-wizard-btn-next">
                    Selanjutnya
                    <iconify-icon icon="solar:arrow-right-linear" class="text-lg"></iconify-icon>
                </button>
            </div>
        </div>

        {{-- ========== Step 3: Detail & Bio ========== --}}
        <div class="biper-wizard-panel" data-panel="2">
            <div class="px-6 py-8 sm:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">No HP</label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="solar:phone-calling-linear"></iconify-icon></span>
                            <input type="text" name="phone" value="{{ old('phone', $isEdit ? $bidan->phone : '') }}"
                                class="form-control @error('phone') border-danger-500 @enderror"
                                placeholder="cth: 081234567890">
                        </div>
                        @error('phone')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">Email Akun</label>
                        <div class="icon-field">
                            <span class="icon"><iconify-icon icon="solar:letter-linear"></iconify-icon></span>
                            <input type="text" id="linkedEmail" value="{{ $isEdit && $bidan->user ? $bidan->user->email : '' }}"
                                class="form-control bg-neutral-50 dark:bg-neutral-600" placeholder="Belum ada akun" readonly disabled>
                        </div>
                        <p class="text-xs text-neutral-400 mt-1">Diatur otomatis dari Step 1.</p>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">Biografi</label>
                        <textarea name="bio" rows="4"
                            class="form-control @error('bio') border-danger-500 @enderror"
                            placeholder="Tuliskan deskripsi singkat mengenai pengalaman, keahlian, dan layanan yang ditawarkan...">{{ old('bio', $isEdit ? $bidan->bio : '') }}</textarea>
                        @error('bio')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Step 3 Navigation --}}
            <div class="biper-wizard-nav">
                <button type="button" class="btn btn-outline-neutral biper-wizard-btn-prev">
                    <iconify-icon icon="solar:arrow-left-linear" class="text-lg"></iconify-icon>
                    Kembali
                </button>
                <button type="button" class="btn btn-primary-600 biper-wizard-btn-next">
                    Selanjutnya
                    <iconify-icon icon="solar:arrow-right-linear" class="text-lg"></iconify-icon>
                </button>
            </div>
        </div>

        {{-- ========== Step 4: Alamat & Lokasi ========== --}}
        <div class="biper-wizard-panel" data-panel="3">
            <div class="px-6 py-8 sm:px-8">
                <div class="space-y-5">
                    <div>
                        <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">Alamat Lengkap</label>
                        <textarea name="address" rows="2"
                            class="form-control @error('address') border-danger-500 @enderror"
                            placeholder="Masukkan alamat lengkap untuk layanan homecare">{{ old('address', $isEdit ? $bidan->address : '') }}</textarea>
                        @error('address')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <div class="biper-map-container">
                            <div class="biper-map-hint">
                                <iconify-icon icon="solar:map-arrow-right-bold" class="text-primary-600 text-lg"></iconify-icon>
                                <span>Klik pada peta untuk menentukan titik lokasi</span>
                            </div>
                            <div id="map" style="height: 350px;"></div>
                        </div>
                        <div class="flex flex-wrap gap-3 mt-3">
                            <div class="biper-coord-badge">
                                <iconify-icon icon="solar:routing-2-outline" class="text-primary-600"></iconify-icon>
                                <span class="text-neutral-500 text-xs">Lat:</span>
                                <input type="text" name="latitude" id="latitude"
                                    value="{{ old('latitude', $isEdit ? $bidan->latitude : '') }}"
                                    class="biper-coord-input" placeholder="&mdash;" readonly>
                            </div>
                            <div class="biper-coord-badge">
                                <iconify-icon icon="solar:routing-2-outline" class="text-primary-600"></iconify-icon>
                                <span class="text-neutral-500 text-xs">Lng:</span>
                                <input type="text" name="longitude" id="longitude"
                                    value="{{ old('longitude', $isEdit ? $bidan->longitude : '') }}"
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

            {{-- Step 4 Navigation --}}
            <div class="biper-wizard-nav">
                <button type="button" class="btn btn-outline-neutral biper-wizard-btn-prev">
                    <iconify-icon icon="solar:arrow-left-linear" class="text-lg"></iconify-icon>
                    Kembali
                </button>
                <button type="button" class="btn btn-primary-600 biper-wizard-btn-next">
                    Selanjutnya
                    <iconify-icon icon="solar:arrow-right-linear" class="text-lg"></iconify-icon>
                </button>
            </div>
        </div>

        {{-- ========== Step 5: Jadwal Praktik ========== --}}
        <div class="biper-wizard-panel" data-panel="4">
            <div class="px-6 py-8 sm:px-8">
                @php
                $days = [
                'monday' => ['Senin', 'Sen', 'S'],
                'tuesday' => ['Selasa', 'Sel', 'S'],
                'wednesday' => ['Rabu', 'Rab', 'R'],
                'thursday' => ['Kamis', 'Kam', 'K'],
                'friday' => ['Jumat', 'Jum', 'J'],
                'saturday' => ['Sabtu', 'Sab', 'S'],
                'sunday' => ['Minggu', 'Min', 'M'],
                ];
                @endphp

                <div class="biper-schedule-grid">
                    @foreach ($days as $key => $labels)
                    @php
                    $hasSchedule = $isEdit && !empty($bidan->schedule[$key]['start']) && !empty($bidan->schedule[$key]['end']);
                    $startVal = old("schedule.{$key}.start", $hasSchedule ? $bidan->schedule[$key]['start'] : '');
                    $endVal = old("schedule.{$key}.end", $hasSchedule ? $bidan->schedule[$key]['end'] : '');
                    $isActive = $hasSchedule || old("schedule.{$key}.start");
                    @endphp
                    <div class="biper-schedule-card {{ $isActive ? 'is-active' : '' }}" data-day="{{ $key }}">
                        <label class="biper-schedule-card__header">
                            <input type="checkbox" class="sr-only peer schedule-toggle" {{ $isActive ? 'checked' : '' }}>
                            <div class="biper-schedule-card__circle">
                                <span class="biper-schedule-card__initial">{{ $labels[2] }}</span>
                                <iconify-icon icon="solar:check-circle-bold" class="biper-schedule-card__check"></iconify-icon>
                            </div>
                            <span class="biper-schedule-card__day">{{ $labels[0] }}</span>
                            <span class="biper-schedule-card__day--short">{{ $labels[1] }}</span>
                        </label>
                        <div class="biper-schedule-card__body">
                            <div class="biper-schedule-card__off">
                                <iconify-icon icon="solar:moon-sleep-bold-duotone" class="text-lg"></iconify-icon>
                                <span>Libur</span>
                            </div>
                            @php
                            $startH = $startVal ? explode(':', $startVal)[0] ?? '' : '';
                            $startM = $startVal ? explode(':', $startVal)[1] ?? '' : '';
                            $endH = $endVal ? explode(':', $endVal)[0] ?? '' : '';
                            $endM = $endVal ? explode(':', $endVal)[1] ?? '' : '';
                            @endphp
                            <div class="biper-schedule-card__times">
                                <div class="biper-schedule-card__time-field">
                                    <label class="biper-schedule-card__time-label">Mulai</label>
                                    <div class="biper-time-picker">
                                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="biper-time-picker__icon"></iconify-icon>
                                        <input type="text" class="biper-time-picker__hour" maxlength="2" placeholder="--"
                                            inputmode="numeric" value="{{ $startH }}" {{ !$isActive ? 'disabled' : '' }}>
                                        <span class="biper-time-picker__sep">:</span>
                                        <input type="text" class="biper-time-picker__min" maxlength="2" placeholder="--"
                                            inputmode="numeric" value="{{ $startM }}" {{ !$isActive ? 'disabled' : '' }}>
                                        <input type="hidden" name="schedule[{{ $key }}][start]"
                                            value="{{ $startVal }}" class="biper-time-picker__value">
                                    </div>
                                </div>
                                <div class="biper-schedule-card__divider">
                                    <iconify-icon icon="solar:arrow-right-linear"></iconify-icon>
                                </div>
                                <div class="biper-schedule-card__time-field">
                                    <label class="biper-schedule-card__time-label">Selesai</label>
                                    <div class="biper-time-picker">
                                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="biper-time-picker__icon"></iconify-icon>
                                        <input type="text" class="biper-time-picker__hour" maxlength="2" placeholder="--"
                                            inputmode="numeric" value="{{ $endH }}" {{ !$isActive ? 'disabled' : '' }}>
                                        <span class="biper-time-picker__sep">:</span>
                                        <input type="text" class="biper-time-picker__min" maxlength="2" placeholder="--"
                                            inputmode="numeric" value="{{ $endM }}" {{ !$isActive ? 'disabled' : '' }}>
                                        <input type="hidden" name="schedule[{{ $key }}][end]"
                                            value="{{ $endVal }}" class="biper-time-picker__value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <p class="text-xs text-neutral-400 mt-5 flex items-center gap-1">
                    <iconify-icon icon="solar:info-circle-outline" class="text-sm"></iconify-icon>
                    Klik pada hari untuk mengaktifkan/menonaktifkan jadwal.
                </p>
            </div>

            {{-- Step 5 Navigation --}}
            <div class="biper-wizard-nav">
                <button type="button" class="btn btn-outline-neutral biper-wizard-btn-prev">
                    <iconify-icon icon="solar:arrow-left-linear" class="text-lg"></iconify-icon>
                    Kembali
                </button>
                <button type="submit" class="btn btn-primary-600 biper-wizard-btn-submit">
                    <iconify-icon icon="{{ $isEdit ? 'solar:pen-bold' : 'solar:check-circle-bold' }}" class="text-lg"></iconify-icon>
                    {{ $isEdit ? 'Perbarui Data' : 'Simpan Data' }}
                </button>
            </div>
        </div>

    </form>
</div>

@endsection

@php
$mapLat = old('latitude', ($isEdit && $bidan->latitude) ? $bidan->latitude : null);
$mapLng = old('longitude', ($isEdit && $bidan->longitude) ? $bidan->longitude : null);
@endphp

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<div id="mapData" data-lat="{{ $mapLat ?? '' }}" data-lng="{{ $mapLng ?? '' }}" style="display:none;"></div>
<script>
    $(function() {

        // ==================== Wizard Navigation ====================
        var currentStep = 0;
        var totalSteps = 5;
        var $steps = $('.biper-wizard-step');
        var $connectors = $('.biper-wizard-step__connector-fill');
        var $panels = $('.biper-wizard-panel');

        function goToStep(step, direction) {
            if (step < 0 || step >= totalSteps) return;

            // Update step indicators
            $steps.each(function(i) {
                $(this).removeClass('active completed');
                if (i < step) $(this).addClass('completed');
                if (i === step) $(this).addClass('active');
            });

            // Update connector fills
            $connectors.each(function(i) {
                $(this).css('width', i < step ? '100%' : '0');
            });

            // Animate panel
            $panels.removeClass('active slide-in-right slide-in-left');
            $panels.eq(step).addClass('active ' + (direction === 'next' ? 'slide-in-right' : 'slide-in-left'));

            currentStep = step;

            // Scroll to top of card
            $('.biper-wizard-card')[0].scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

            // Invalidate map on location step
            if (step === 3 && typeof map !== 'undefined') {
                setTimeout(function() {
                    map.invalidateSize();
                }, 300);
            }
        }

        // Next / Prev buttons
        $(document).on('click', '.biper-wizard-btn-next', function() {
            goToStep(currentStep + 1, 'next');
        });
        $(document).on('click', '.biper-wizard-btn-prev', function() {
            goToStep(currentStep - 1, 'prev');
        });

        // Clickable step indicators (only go back to completed steps)
        $steps.on('click', function() {
            var target = parseInt($(this).data('step'));
            if (target < currentStep) {
                goToStep(target, 'prev');
            }
        });

        // ==================== Photo Upload Preview ====================
        document.getElementById('photo').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('imagePreview').style.backgroundImage = 'url(' + ev.target.result + ')';
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // ==================== Link User / New Account ====================
        var $userSelect = $('#userSelect');
        var $nameField = $('input[name="name"]');
        var $linkedInfo = $('#linkedUserInfo');
        var $linkedEmail = $('#linkedEmail');
        var $newAccountFields = $('#newAccountFields');
        var $newEmail = $('#newEmail');

        function updateLinkedState() {
            var val = $userSelect.val();
            var $selected = $userSelect.find('option:selected');

            if (val === 'new') {
                // Create new account mode
                $newAccountFields.slideDown(200);
                $linkedInfo.hide();
                $linkedEmail.val($newEmail.val() || '');
                if ($nameField.data('auto-filled')) {
                    $nameField.val('').data('auto-filled', false);
                }
            } else if (val) {
                // Link existing user mode
                $newAccountFields.slideUp(200);
                var userName = $selected.data('name');
                if ($nameField.val() === '' || $nameField.data('auto-filled')) {
                    $nameField.val(userName).data('auto-filled', true);
                }
                var optionText = $selected.text();
                var emailMatch = optionText.match(/\((.+)\)/);
                $linkedEmail.val(emailMatch ? emailMatch[1] : '');
                $linkedInfo.show();
            }
        }

        $userSelect.on('change', updateLinkedState);
        $nameField.on('input', function() {
            $(this).data('auto-filled', false);
        });
        $newEmail.on('input', function() {
            $linkedEmail.val($(this).val());
        });
        updateLinkedState();

        // ==================== Experience Stepper ====================
        var $expInput = $('#expInput');
        var $expValue = $('#expValue');
        var expMin = 0,
            expMax = 50;

        function setExp(val) {
            val = Math.max(expMin, Math.min(expMax, val));
            $expInput.val(val);
            $expValue.text(val);
        }

        $('#expMinus').on('click', function() {
            setExp(parseInt($expInput.val()) - 1);
        });
        $('#expPlus').on('click', function() {
            setExp(parseInt($expInput.val()) + 1);
        });

        // ==================== Time Picker (Segmented Input) ====================
        $('.biper-time-picker').each(function() {
            var $picker = $(this);
            var $hour = $picker.find('.biper-time-picker__hour');
            var $min = $picker.find('.biper-time-picker__min');
            var $hidden = $picker.find('.biper-time-picker__value');

            function syncHidden() {
                var h = $hour.val();
                var m = $min.val();
                $hidden.val(h.length === 2 && m.length === 2 ? h + ':' + m : '');
            }

            function handleDigitInput(e, $field, max, $next) {
                var key = e.key;

                // Allow tab, arrow keys
                if (['Tab', 'ArrowLeft', 'ArrowRight'].indexOf(key) >= 0) return;

                // Backspace: if empty, jump back
                if (key === 'Backspace') {
                    if ($field.val() === '' && $field.is($min)) {
                        e.preventDefault();
                        $hour.focus().select();
                    }
                    return;
                }

                // Block non-digit
                if (!/^[0-9]$/.test(key)) {
                    e.preventDefault();
                    return;
                }

                e.preventDefault();
                var current = $field.val();

                // If field is full or selected all, start fresh
                if (current.length >= 2 || $field[0].selectionStart === 0 && $field[0].selectionEnd === 2) {
                    current = '';
                }

                var next = current + key;

                // Validate range
                if (parseInt(next) > max) {
                    next = '0' + key;
                }

                $field.val(next);

                // Auto-advance when 2 digits typed
                if (next.length === 2 && $next) {
                    $next.focus().select();
                }

                syncHidden();
            }

            $hour.on('keydown', function(e) {
                handleDigitInput(e, $hour, 23, $min);
            });
            $min.on('keydown', function(e) {
                handleDigitInput(e, $min, 59, null);
            });

            // Select all on focus for easy overwrite
            $hour.on('focus', function() {
                this.select();
            });
            $min.on('focus', function() {
                this.select();
            });

            // Pad on blur (e.g. "8" → "08")
            $hour.on('blur', function() {
                var v = $(this).val();
                if (v.length === 1) $(this).val('0' + v);
                syncHidden();
            });
            $min.on('blur', function() {
                var v = $(this).val();
                if (v.length === 1) $(this).val('0' + v);
                syncHidden();
            });

            // Click icon → focus hour
            $picker.find('.biper-time-picker__icon').on('click', function() {
                $hour.focus().select();
            });
        });

        // ==================== Schedule Toggle ====================
        $(document).on('change', '.schedule-toggle', function() {
            var $card = $(this).closest('.biper-schedule-card');
            var $fields = $card.find('.biper-time-picker__hour, .biper-time-picker__min');
            var $hidden = $card.find('.biper-time-picker__value');

            if (this.checked) {
                $card.addClass('is-active');
                $fields.prop('disabled', false);
            } else {
                $card.removeClass('is-active');
                $fields.prop('disabled', true).val('');
                $hidden.val('');
            }
        });

        // ==================== Leaflet Map ====================
        var defaultLat = -6.200000;
        var defaultLng = 106.816666;
        var mapData = document.getElementById('mapData');
        var initialLat = mapData.dataset.lat ? parseFloat(mapData.dataset.lat) : null;
        var initialLng = mapData.dataset.lng ? parseFloat(mapData.dataset.lng) : null;

        var map = L.map('map').setView(
            [initialLat || defaultLat, initialLng || defaultLng],
            initialLat ? 15 : 5
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        var marker = null;

        if (initialLat && initialLng) {
            marker = L.marker([initialLat, initialLng]).addTo(map);
        }

        map.on('click', function(e) {
            document.getElementById('latitude').value = e.latlng.lat.toFixed(8);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(8);

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        });

    });
</script>
@endpush