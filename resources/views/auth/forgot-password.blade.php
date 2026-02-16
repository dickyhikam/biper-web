<x-landing-page>
    <x-slot:title>Lupa Password - Biper Baby Spa</x-slot:title>

    <div class="min-h-screen flex items-center justify-center py-32 px-4 bg-biper-pink-light/30 relative overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-yellow/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="w-full max-w-md relative z-10">

            <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-12">

                {{-- Icon --}}
                <div class="w-20 h-20 bg-gradient-to-r from-biper-yellow to-yellow-500 rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-6 shadow-lg shadow-biper-yellow/30">
                    <i class="fas fa-key"></i>
                </div>

                <h1 class="font-display font-bold text-3xl text-center text-gray-800 mb-2">Lupa Password?</h1>
                <p class="text-center text-gray-500 mb-8">Tenang, kami akan kirim link reset ke email Bunda</p>

                {{-- Success Message (placeholder) --}}
                <div class="hidden mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm items-start gap-3">
                    <i class="fas fa-check-circle text-lg mt-0.5"></i>
                    <span>Link reset password telah dikirim ke email Bunda!</span>
                </div>

                <form action="#" method="POST" class="space-y-6">

                    {{-- Email Input --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-biper-pink mr-2"></i>Email Terdaftar
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition"
                            placeholder="bunda@email.com"
                            required
                            autofocus
                        >
                        <p class="text-xs text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Kami akan mengirim link reset ke email ini
                        </p>
                    </div>

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-6 py-3.5 rounded-full font-semibold shadow-lg shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:-translate-y-0.5 transition-all duration-300"
                    >
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Link Reset
                    </button>

                </form>

                {{-- Back to Login --}}
                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <a href="/login" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-biper-pink transition">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke halaman login
                    </a>
                </div>

            </div>

        </div>
    </div>

</x-landing-page>
