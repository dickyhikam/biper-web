<x-landing-page>
    <x-slot:title>Data Anak - Biper Baby Spa</x-slot:title>

    <div class="min-h-screen flex items-center justify-center py-32 px-4 bg-biper-pink-light/30 relative overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="w-full max-w-lg relative z-10" x-data="{ jenisKelamin: '' }">

            <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-12">

                {{-- Icon --}}
                <div class="w-20 h-20 bg-gradient-to-r from-biper-blue to-biper-blue-dark rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-6 shadow-lg shadow-biper-blue/30">
                    <i class="fas fa-baby"></i>
                </div>

                <h1 class="font-display font-bold text-3xl text-center text-gray-800 mb-2">Data Si Kecil</h1>
                <p class="text-center text-gray-500 mb-8">
                    Tambahkan data anak untuk mempermudah proses booking
                </p>

                {{-- Success Message --}}
                @if (session('message'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-start gap-3">
                        <i class="fas fa-check-circle text-lg mt-0.5"></i>
                        <span>{{ session('message') }}</span>
                    </div>
                @endif

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm flex items-start gap-3">
                        <i class="fas fa-exclamation-circle text-lg mt-0.5"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Daftar anak yang sudah ditambahkan --}}
                @if ($anaks->count() > 0)
                    <div class="mb-8 space-y-3">
                        <p class="text-sm font-semibold text-gray-600 mb-2">
                            <i class="fas fa-children text-biper-pink mr-1"></i>
                            Anak yang sudah ditambahkan ({{ $anaks->count() }})
                        </p>

                        @foreach ($anaks as $anak)
                            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-biper-pink-light/20 to-biper-blue-light/20 border border-biper-pink/20 rounded-xl">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-sm
                                    {{ $anak->jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-500' : 'bg-pink-100 text-pink-500' }}">
                                    <i class="fas {{ $anak->jenis_kelamin === 'L' ? 'fa-mars' : 'fa-venus' }}"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-gray-800 truncate">{{ $anak->nama }}</h3>
                                    <p class="text-xs text-gray-500">
                                        {{ $anak->tanggal_lahir->translatedFormat('d F Y') }}
                                        &middot; {{ $anak->usia_bulan }} bulan
                                    </p>
                                </div>
                                <form action="{{ route('anak.destroy', $anak) }}" method="POST"
                                      onsubmit="return confirm('Hapus data {{ $anak->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition">
                                        <i class="fas fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Form tambah anak --}}
                <form action="{{ route('anak.store') }}" method="POST" class="space-y-5">
                    @csrf

                    @if ($anaks->count() > 0)
                        <div class="flex items-center gap-3 mb-2">
                            <div class="flex-1 h-px bg-gray-200"></div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tambah Anak</span>
                            <div class="flex-1 h-px bg-gray-200"></div>
                        </div>
                    @endif

                    {{-- Nama Anak --}}
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-baby text-biper-pink mr-2"></i>Nama Anak
                        </label>
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama') }}"
                            class="w-full px-4 py-3 border-2 {{ $errors->has('nama') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition"
                            placeholder="Contoh: Muhammad Arkan"
                            required
                        >
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-biper-pink mr-2"></i>Tanggal Lahir
                        </label>
                        <input
                            type="date"
                            id="tanggal_lahir"
                            name="tanggal_lahir"
                            value="{{ old('tanggal_lahir') }}"
                            max="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 border-2 {{ $errors->has('tanggal_lahir') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition"
                            required
                        >
                        @error('tanggal_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-venus-mars text-biper-pink mr-2"></i>Jenis Kelamin
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label
                                class="cursor-pointer"
                                @click="jenisKelamin = 'L'"
                            >
                                <input type="radio" name="jenis_kelamin" value="L" class="hidden peer" {{ old('jenis_kelamin') === 'L' ? 'checked' : '' }} required>
                                <div class="flex items-center gap-3 p-4 border-2 rounded-xl transition-all duration-200
                                    peer-checked:border-blue-400 peer-checked:bg-blue-50
                                    border-gray-200 hover:border-blue-300">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-500 flex items-center justify-center text-lg">
                                        <i class="fas fa-mars"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Laki-laki</span>
                                </div>
                            </label>
                            <label
                                class="cursor-pointer"
                                @click="jenisKelamin = 'P'"
                            >
                                <input type="radio" name="jenis_kelamin" value="P" class="hidden peer" {{ old('jenis_kelamin') === 'P' ? 'checked' : '' }} required>
                                <div class="flex items-center gap-3 p-4 border-2 rounded-xl transition-all duration-200
                                    peer-checked:border-pink-400 peer-checked:bg-pink-50
                                    border-gray-200 hover:border-pink-300">
                                    <div class="w-10 h-10 rounded-lg bg-pink-100 text-pink-500 flex items-center justify-center text-lg">
                                        <i class="fas fa-venus"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Perempuan</span>
                                </div>
                            </label>
                        </div>
                        @error('jenis_kelamin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-biper-blue to-biper-blue-dark text-white px-6 py-3.5 rounded-full font-semibold shadow-lg shadow-biper-blue/30 hover:shadow-biper-blue/50 hover:-translate-y-0.5 transition-all duration-300"
                    >
                        <i class="fas fa-plus-circle mr-2"></i>
                        {{ $anaks->count() > 0 ? 'Tambah Anak Lagi' : 'Simpan Data Anak' }}
                    </button>
                </form>

                {{-- Lanjutkan Button --}}
                @if ($anaks->count() > 0)
                    <form action="{{ route('anak.complete') }}" method="POST" class="mt-4">
                        @csrf
                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-6 py-3.5 rounded-full font-semibold shadow-lg shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:-translate-y-0.5 transition-all duration-300"
                        >
                            Lanjutkan<i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </form>
                @endif

            </div>

            {{-- Logout --}}
            <div class="mt-6 text-center">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-biper-pink transition">
                        <i class="fas fa-arrow-left"></i>
                        Keluar
                    </button>
                </form>
            </div>

        </div>
    </div>

</x-landing-page>
