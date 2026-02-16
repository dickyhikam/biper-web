<x-landing-page>
    <x-slot:title>Reset Password - Biper Baby Spa</x-slot:title>

    <div class="min-h-screen flex items-center justify-center py-32 px-4 bg-biper-pink-light/30 relative overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-green-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="w-full max-w-md relative z-10" x-data="{ showPassword: false, showPasswordConfirm: false }">

            <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-12">

                {{-- Icon --}}
                <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-6 shadow-lg shadow-green-500/30">
                    <i class="fas fa-lock-open"></i>
                </div>

                <h1 class="font-display font-bold text-3xl text-center text-gray-800 mb-2">Reset Password</h1>
                <p class="text-center text-gray-500 mb-8">Buat password baru untuk akun Bunda</p>

                <form action="#" method="POST" class="space-y-6">

                    {{-- Email (readonly) --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-biper-pink mr-2"></i>Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="bunda@email.com"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed"
                            readonly
                        >
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock text-biper-pink mr-2"></i>Password Baru
                        </label>
                        <div class="relative">
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition pr-12"
                                placeholder="Minimal 8 karakter"
                                required
                                autofocus
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
                                placeholder="Ketik ulang password baru"
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

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3.5 rounded-full font-semibold shadow-lg shadow-green-500/30 hover:shadow-green-500/50 hover:-translate-y-0.5 transition-all duration-300"
                    >
                        <i class="fas fa-check mr-2"></i>Reset Password
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-landing-page>
