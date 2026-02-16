<x-landing-page>
    <x-slot:title>Daftar - Biper Baby Spa</x-slot:title>

    <div class="min-h-screen flex items-center justify-center py-32 px-4 bg-biper-pink-light/30 relative overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="w-full max-w-lg relative z-10" x-data="{
            showPassword: false,
            showPasswordConfirm: false,
            termsAccepted: false
        }">

            <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-12">

                {{-- Icon --}}
                <div class="w-20 h-20 bg-gradient-to-r from-biper-blue to-biper-blue-dark rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-6 shadow-lg shadow-biper-blue/30">
                    <i class="fas fa-user-plus"></i>
                </div>

                <h1 class="font-display font-bold text-3xl text-center text-gray-800 mb-2">Buat Akun Baru</h1>
                <p class="text-center text-gray-500 mb-8">Daftar untuk nikmati kemudahan booking</p>

                {{-- Error Summary --}}
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

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Nickname + Name --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user text-biper-pink mr-2"></i>Panggilan & Nama Lengkap
                        </label>
                        <div class="flex gap-3">
                            <select
                                name="nickname"
                                class="w-28 shrink-0 px-3 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition bg-white text-gray-700 font-medium"
                            >
                                @foreach (\App\Models\User::NICKNAMES as $nick)
                                    <option value="{{ $nick }}" {{ old('nickname', 'Bunda') === $nick ? 'selected' : '' }}>{{ $nick }}</option>
                                @endforeach
                            </select>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="flex-1 px-4 py-3 border-2 {{ $errors->has('name') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition"
                                placeholder="Contoh: Sarah Amanda"
                                required
                            >
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-biper-pink mr-2"></i>Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 border-2 {{ $errors->has('email') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition"
                            placeholder="bunda@email.com"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone/WhatsApp --}}
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fab fa-whatsapp text-biper-pink mr-2"></i>No. WhatsApp
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="w-full px-4 py-3 border-2 {{ $errors->has('phone') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition"
                            placeholder="081234567890"
                            required
                        >
                        <p class="text-xs text-gray-500 mt-1">Untuk konfirmasi booking via WhatsApp</p>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock text-biper-pink mr-2"></i>Password
                        </label>
                        <div class="relative">
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 border-2 {{ $errors->has('password') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition pr-12"
                                placeholder="Minimal 8 karakter"
                                required
                            >
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-biper-pink transition"
                            >
                                <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock text-biper-pink mr-2"></i>Konfirmasi Password
                        </label>
                        <div class="relative">
                            <input
                                :type="showPasswordConfirm ? 'text' : 'password'"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition pr-12"
                                placeholder="Ketik ulang password"
                                required
                            >
                            <button
                                type="button"
                                @click="showPasswordConfirm = !showPasswordConfirm"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-biper-pink transition"
                            >
                                <i :class="showPasswordConfirm ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Terms Checkbox --}}
                    <div>
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input
                                type="checkbox"
                                x-model="termsAccepted"
                                class="w-4 h-4 text-biper-pink border-gray-300 rounded focus:ring-biper-pink mt-1"
                                required
                            >
                            <span class="text-sm text-gray-600">
                                Saya setuju dengan
                                <a href="#" class="text-biper-pink hover:underline">syarat & ketentuan</a>
                                serta
                                <a href="#" class="text-biper-pink hover:underline">kebijakan privasi</a>
                                Biper Baby Spa
                            </span>
                        </label>
                    </div>

                    {{-- Register Button --}}
                    <button
                        type="submit"
                        :disabled="!termsAccepted"
                        :class="termsAccepted ? 'bg-gradient-to-r from-biper-blue to-biper-blue-dark shadow-biper-blue/30 hover:shadow-biper-blue/50' : 'bg-gray-300 cursor-not-allowed'"
                        class="w-full text-white px-6 py-3.5 rounded-full font-semibold shadow-lg hover:-translate-y-0.5 transition-all duration-300"
                    >
                        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                    </button>

                </form>

                {{-- Login Link --}}
                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-biper-pink hover:text-biper-pink-dark font-semibold underline">
                            Masuk di sini
                        </a>
                    </p>
                </div>

            </div>

            {{-- Back to Home --}}
            <div class="mt-6 text-center">
                <a href="{{ route('pageHome') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-biper-pink transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>

</x-landing-page>
