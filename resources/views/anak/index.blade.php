<x-landing-page>
    <x-slot:title>Data Anak Saya - Biper Baby Spa</x-slot:title>

    <div class="min-h-screen py-32 px-4 bg-biper-pink-light/30 relative overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="max-w-2xl mx-auto relative z-10">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-r from-biper-blue to-biper-blue-dark rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-6 shadow-lg shadow-biper-blue/30">
                    <i class="fas fa-children"></i>
                </div>
                <h1 class="font-display font-bold text-3xl text-gray-800 mb-2">Data Anak Saya</h1>
                <p class="text-gray-500">Kelola data anak untuk mempermudah proses booking</p>
            </div>

            {{-- Success Message --}}
            @if (session('message'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-start gap-3">
                    <i class="fas fa-check-circle text-lg mt-0.5"></i>
                    <span>{{ session('message') }}</span>
                </div>
            @endif

            {{-- Child List --}}
            @if ($anaks->count() > 0)
                <div class="space-y-4 mb-8">
                    @foreach ($anaks as $anak)
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-5 flex items-center gap-4 hover:shadow-lg transition-shadow">
                            <div class="w-14 h-14 rounded-xl flex items-center justify-center text-2xl shadow-sm flex-shrink-0
                                {{ $anak->jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-500' : 'bg-pink-100 text-pink-500' }}">
                                <i class="fas {{ $anak->jenis_kelamin === 'L' ? 'fa-mars' : 'fa-venus' }}"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-800 text-lg truncate">{{ $anak->nama }}</h3>
                                <div class="flex flex-wrap items-center gap-2 mt-1">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-calendar-alt text-biper-pink mr-1"></i>
                                        {{ $anak->tanggal_lahir->translatedFormat('d F Y') }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-biper-blue-light/30 text-biper-blue-dark text-xs font-semibold rounded-full">
                                        <i class="fas fa-cake-candles"></i>
                                        {{ $anak->usia_bulan }} bulan
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <a href="{{ route('anak.edit', $anak) }}" class="w-10 h-10 rounded-xl bg-biper-blue-light/30 text-biper-blue-dark hover:bg-biper-blue-light/50 flex items-center justify-center transition">
                                    <i class="fas fa-pen text-sm"></i>
                                </a>
                                <form action="{{ route('anak.destroy', $anak) }}" method="POST"
                                      onsubmit="return confirm('Hapus data {{ $anak->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition">
                                        <i class="fas fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-12 text-center mb-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-300 text-3xl mx-auto mb-4">
                        <i class="fas fa-baby"></i>
                    </div>
                    <p class="text-gray-400 font-medium">Belum ada data anak</p>
                    <p class="text-gray-400 text-sm mt-1">Tambahkan data anak untuk mulai booking</p>
                </div>
            @endif

            {{-- Add Child Button --}}
            <div class="text-center">
                <a href="{{ route('anak.create') }}"
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-8 py-3.5 rounded-full font-semibold shadow-lg shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Anak
                </a>
            </div>

        </div>
    </div>

</x-landing-page>
