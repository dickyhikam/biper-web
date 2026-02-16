@php
$isEdit = isset($slide);
@endphp

@extends('admin.layouts.app')

@section('title', $isEdit ? 'Edit Slide' : 'Tambah Slide')
@section('page-title', $isEdit ? 'Edit Slide' : 'Tambah Slide')
@section('breadcrumb', $isEdit ? 'Edit Slide' : 'Tambah Slide')

@section('content')

<div class="card border-0 rounded-lg max-w-3xl">
    <div class="card-body p-6">
        <div class="flex items-center justify-between mb-6">
            <h6 class="font-bold text-lg mb-0">{{ $isEdit ? 'Edit Slide' : 'Tambah Slide Baru' }}</h6>
            <a href="{{ route('admin.slides.index') }}"
                class="bg-neutral-200 dark:bg-neutral-600 hover:bg-neutral-300 dark:hover:bg-neutral-500 text-neutral-700 dark:text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
                <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
                Kembali
            </a>
        </div>

        <form action="{{ $isEdit ? route('admin.slides.update', $slide) : route('admin.slides.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if ($isEdit) @method('PUT') @endif

            {{-- Image Upload --}}
            <div class="mb-6">
                <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                    Gambar Slide
                </label>
                <div class="biper-slide-upload" id="slideUploadArea">
                    <div class="biper-slide-upload__preview" id="slidePreview"
                        style="background-image: url('{{ ($isEdit && $slide->image_url) ? $slide->image_url : '' }}');">
                        <div class="biper-slide-upload__placeholder" id="slidePlaceholder"
                            style="{{ ($isEdit && $slide->image_url) ? 'display:none;' : '' }}">
                            <iconify-icon icon="solar:gallery-add-bold-duotone" class="text-4xl text-neutral-300 dark:text-neutral-500"></iconify-icon>
                            <span class="text-sm text-neutral-400 mt-2">Klik untuk upload gambar</span>
                            <span class="text-xs text-neutral-400">Rekomendasi: 1600 x 750 px</span>
                        </div>
                    </div>
                    <input type="file" id="slideImage" name="image" accept=".png,.jpg,.jpeg,.webp" hidden>
                </div>
                @error('image')
                <p class="text-danger-600 text-xs mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-neutral-400 mt-2">Maks 2MB &middot; JPG, PNG, WebP</p>
            </div>

            {{-- Title & Subtitle --}}
            <div class="grid grid-cols-1 gap-5 mb-5">
                <div>
                    <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                        Judul <span class="text-danger-600">*</span>
                    </label>
                    <div class="icon-field">
                        <span class="icon"><iconify-icon icon="solar:text-bold"></iconify-icon></span>
                        <input type="text" name="title" value="{{ old('title', $isEdit ? $slide->title : '') }}"
                            class="form-control @error('title') border-danger-500 @enderror"
                            placeholder="cth: Sentuhan Cinta Medis" maxlength="50" data-counter="titleCounter">
                    </div>
                    <div class="flex items-center justify-between mt-1">
                        @error('title')
                        <p class="text-danger-600 text-xs">{{ $message }}</p>
                        @else
                        <span></span>
                        @enderror
                        <span id="titleCounter" class="text-xs text-neutral-400"></span>
                    </div>
                </div>
                <div>
                    <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                        Subtitle
                    </label>
                    <textarea name="subtitle" rows="2"
                        class="form-control @error('subtitle') border-danger-500 @enderror"
                        placeholder="Deskripsi singkat yang muncul di bawah judul" maxlength="100" data-counter="subtitleCounter">{{ old('subtitle', $isEdit ? $slide->subtitle : '') }}</textarea>
                    <div class="flex items-center justify-between mt-1">
                        @error('subtitle')
                        <p class="text-danger-600 text-xs">{{ $message }}</p>
                        @else
                        <span></span>
                        @enderror
                        <span id="subtitleCounter" class="text-xs text-neutral-400"></span>
                    </div>
                </div>
            </div>

            {{-- CTA Text & Link --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                        Teks Tombol (CTA)
                    </label>
                    <div class="icon-field">
                        <span class="icon"><iconify-icon icon="solar:cursor-bold"></iconify-icon></span>
                        <input type="text" name="cta_text" value="{{ old('cta_text', $isEdit ? $slide->cta_text : '') }}"
                            class="form-control @error('cta_text') border-danger-500 @enderror"
                            placeholder="cth: Reservasi Sekarang">
                    </div>
                    @error('cta_text')
                    <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                        Link Tombol
                    </label>
                    <div class="icon-field">
                        <span class="icon"><iconify-icon icon="solar:link-round-bold"></iconify-icon></span>
                        <input type="text" name="cta_link" value="{{ old('cta_link', $isEdit ? $slide->cta_link : '#booking') }}"
                            class="form-control @error('cta_link') border-danger-500 @enderror"
                            placeholder="cth: #booking atau /layanan">
                    </div>
                    @error('cta_link')
                    <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Overlay Color, Sort Order, Status --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
                <div>
                    <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                        Warna Overlay <span class="text-danger-600">*</span>
                    </label>
                    <div class="biper-color-options">
                        @php
                        $currentColor = old('overlay_color', $isEdit ? $slide->overlay_color : 'pink');
                        @endphp
                        <label class="biper-color-option">
                            <input type="radio" name="overlay_color" value="pink" class="sr-only peer"
                                {{ $currentColor === 'pink' ? 'checked' : '' }}>
                            <div class="biper-color-option__swatch biper-color-option__swatch--pink"></div>
                            <span class="biper-color-option__label">Pink</span>
                        </label>
                        <label class="biper-color-option">
                            <input type="radio" name="overlay_color" value="blue" class="sr-only peer"
                                {{ $currentColor === 'blue' ? 'checked' : '' }}>
                            <div class="biper-color-option__swatch biper-color-option__swatch--blue"></div>
                            <span class="biper-color-option__label">Blue</span>
                        </label>
                        <label class="biper-color-option">
                            <input type="radio" name="overlay_color" value="dark" class="sr-only peer"
                                {{ $currentColor === 'dark' ? 'checked' : '' }}>
                            <div class="biper-color-option__swatch biper-color-option__swatch--dark"></div>
                            <span class="biper-color-option__label">Dark</span>
                        </label>
                    </div>
                    @error('overlay_color')
                    <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="form-label font-semibold text-neutral-600 dark:text-neutral-300 mb-2">
                        Urutan <span class="text-danger-600">*</span>
                    </label>
                    <div class="icon-field">
                        <span class="icon"><iconify-icon icon="solar:sort-from-top-to-bottom-linear"></iconify-icon></span>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $isEdit ? $slide->sort_order : 0) }}"
                            class="form-control @error('sort_order') border-danger-500 @enderror"
                            min="0" placeholder="0">
                    </div>
                    @error('sort_order')
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
                                {{ old('is_active', $isEdit ? $slide->is_active : true) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-neutral-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 rounded-full peer dark:bg-neutral-600 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                        </label>
                        <span class="text-sm font-medium text-neutral-600 dark:text-neutral-300">Aktif</span>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-3 pt-4 border-t border-neutral-200 dark:border-neutral-600">
                <button type="submit" class="btn btn-primary-600 flex items-center gap-2 px-6 py-2.5 rounded-lg">
                    <iconify-icon icon="{{ $isEdit ? 'solar:pen-bold' : 'solar:check-circle-bold' }}" class="text-lg"></iconify-icon>
                    {{ $isEdit ? 'Perbarui Slide' : 'Simpan Slide' }}
                </button>
                <a href="{{ route('admin.slides.index') }}" class="btn btn-outline-neutral px-6 py-2.5 rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(function() {
        // Image upload preview
        var $area = $('#slideUploadArea');
        var $input = $('#slideImage');
        var $preview = $('#slidePreview');
        var $placeholder = $('#slidePlaceholder');

        $area.on('click', function(e) {
            if (e.target !== $input[0]) $input.trigger('click');
        });

        $input.on('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    $preview.css('background-image', 'url(' + ev.target.result + ')');
                    $placeholder.hide();
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Character counters
        $('[data-counter]').each(function() {
            var $field = $(this);
            var max = parseInt($field.attr('maxlength'));
            var $counter = $('#' + $field.data('counter'));

            function update() {
                var len = $field.val().length;
                $counter.text(len + ' / ' + max);
                $counter.toggleClass('text-danger-600', len >= max);
                $counter.toggleClass('text-neutral-400', len < max);
            }
            update();
            $field.on('input', update);
        });
    });
</script>
@endpush