<x-landing-page>
    <x-slot:title>Masuk - Biper Baby Spa</x-slot:title>

    {{-- Hero Background --}}
    <div class="min-h-screen flex items-center justify-center py-32 px-4 bg-biper-pink-light/30 relative overflow-hidden">

        {{-- Decorative Background Blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="w-full max-w-md relative z-10" x-data="{ showPassword: false }">

            {{-- Login Card --}}
            <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-12">

                {{-- Logo/Icon --}}
                <div class="w-20 h-20 bg-gradient-to-r from-biper-pink to-biper-pink-dark rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-6 shadow-lg shadow-biper-pink/30">
                    <i class="fas fa-user-circle"></i>
                </div>

                {{-- Title --}}
                <h1 class="font-display font-bold text-3xl text-center text-gray-800 mb-2">Selamat Datang</h1>
                <p class="text-center text-gray-500 mb-8">Masuk untuk booking lebih cepat</p>

                {{-- Success Message (placeholder for future backend) --}}
                <div class="hidden mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm items-start gap-3">
                    <i class="fas fa-check-circle text-lg mt-0.5"></i>
                    <span>Akun berhasil dibuat! Silakan login.</span>
                </div>

                {{-- Login Form --}}
                <form action="#" method="POST" class="space-y-6">

                    {{-- Email/Phone Input --}}
                    <div>
                        <label for="login" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-biper-pink mr-2"></i>Email atau No. WhatsApp
                        </label>
                        <input
                            type="text"
                            id="login"
                            name="login"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition"
                            placeholder="bunda@email.com atau 081234567890"
                            required
                            autofocus
                        >
                    </div>

                    {{-- Password Input --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock text-biper-pink mr-2"></i>Password
                        </label>
                        <div class="relative">
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition pr-12"
                                placeholder="Masukkan password"
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
                    </div>

                    {{-- Remember Me & Forgot Password --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4 text-biper-pink border-gray-300 rounded focus:ring-biper-pink"
                            >
                            <span class="text-sm text-gray-600">Ingat Saya</span>
                        </label>
                        <a href="/forgot-password" class="text-sm text-biper-pink hover:text-biper-pink-dark underline">
                            Lupa Password?
                        </a>
                    </div>

                    {{-- Login Button --}}
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-6 py-3.5 rounded-full font-semibold shadow-lg shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:-translate-y-0.5 transition-all duration-300"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </button>

                </form>

                {{-- Divider --}}
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">atau</span>
                    </div>
                </div>

                {{-- Register Link --}}
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun?
                        <a href="/register" class="text-biper-pink hover:text-biper-pink-dark font-semibold underline">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>

                {{-- Benefits --}}
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <p class="text-xs text-gray-500 text-center mb-3">Keuntungan Punya Akun:</p>
                    <div class="flex justify-center gap-4 text-xs text-gray-600">
                        <span class="flex items-center gap-1">
                            <i class="fas fa-check-circle text-green-500"></i> Booking Cepat
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="fas fa-check-circle text-green-500"></i> Data Tersimpan
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="fas fa-check-circle text-green-500"></i> Poin Reward
                        </span>
                    </div>
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
