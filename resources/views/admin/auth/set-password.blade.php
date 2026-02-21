<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Password - Biper Baby Care</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-text.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-50 antialiased h-screen overflow-hidden">

    <div class="h-screen flex" x-data="{ showPassword: false, showPasswordConfirm: false }">

        {{-- Left Panel --}}
        <div class="hidden lg:flex lg:w-[480px] bg-gradient-to-br from-biper-pink via-biper-pink-dark to-[#8a0e5e] relative overflow-hidden">

            {{-- Decorative --}}
            <div class="absolute top-[-100px] right-[-80px] w-[350px] h-[350px] rounded-full bg-white/[0.06]"></div>
            <div class="absolute bottom-[-60px] left-[-40px] w-[250px] h-[250px] rounded-full bg-white/[0.04]"></div>

            {{-- Content --}}
            <div class="relative z-10 flex flex-col justify-between p-10 w-full">

                {{-- Logo --}}
                <div>
                    <img src="{{ asset('images/logo-text.png') }}" alt="Biper" class="h-10 brightness-0 invert opacity-90">
                </div>

                {{-- Center --}}
                <div>
                    <img src="{{ asset('images/logo.png') }}" alt="Biper Baby Care"
                         class="w-28 h-28 rounded-3xl shadow-2xl shadow-black/20 mb-6">
                    <h1 class="font-display text-3xl font-bold text-white leading-tight mb-3">
                        Selamat Datang<br>di Biper Baby Care
                    </h1>
                    <p class="text-white/60 text-sm leading-relaxed max-w-[280px]">
                        Buat password untuk mulai mengakses Admin Panel Biper Baby Spa.
                    </p>
                </div>

                {{-- Footer --}}
                <p class="text-white/30 text-xs">&copy; {{ date('Y') }} Biper Baby Care</p>
            </div>
        </div>

        {{-- Right Panel --}}
        <div class="flex-1 flex items-center justify-center px-6">
            <div class="w-full max-w-[420px]">

                {{-- Mobile Logo --}}
                <div class="lg:hidden flex justify-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Biper" class="w-16 h-16 rounded-2xl shadow-lg shadow-biper-pink/20">
                </div>

                {{-- Header --}}
                <div class="mb-7">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 text-xs font-semibold px-3 py-1 rounded-full">
                            <i class="fas fa-key text-[10px]"></i>
                            Buat Password
                        </span>
                    </div>
                    <h2 class="font-display text-2xl font-bold text-gray-800">Buat Password Baru</h2>
                    <p class="text-gray-400 text-sm mt-1">Buat password untuk akun <strong class="text-gray-600">{{ $email }}</strong></p>
                </div>

                {{-- Error --}}
                @if ($errors->any())
                    <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3 text-sm text-red-600">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('admin.set-password.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-600 mb-1.5">Password <span class="text-biper-pink">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-300">
                                <i class="fas fa-lock text-sm"></i>
                            </span>
                            <input :type="showPassword ? 'text' : 'password'" name="password" id="password"
                                   class="w-full pl-10 pr-11 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-biper-pink focus:ring-2 focus:ring-biper-pink/10 transition"
                                   placeholder="Minimal 8 karakter" autofocus>
                            <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-300 hover:text-biper-pink transition">
                                <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-sm"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1.5">Konfirmasi Password <span class="text-biper-pink">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-300">
                                <i class="fas fa-lock text-sm"></i>
                            </span>
                            <input :type="showPasswordConfirm ? 'text' : 'password'" name="password_confirmation" id="password_confirmation"
                                   class="w-full pl-10 pr-11 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-biper-pink focus:ring-2 focus:ring-biper-pink/10 transition"
                                   placeholder="Ulangi password">
                            <button type="button" @click="showPasswordConfirm = !showPasswordConfirm"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-300 hover:text-biper-pink transition">
                                <i :class="showPasswordConfirm ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-sm"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white py-3 rounded-xl font-semibold shadow-lg shadow-biper-pink/25 hover:shadow-biper-pink/40 hover:-translate-y-0.5 transition-all duration-300 text-sm">
                        <i class="fas fa-check mr-2"></i>Buat Password & Masuk
                    </button>
                </form>

                {{-- Back --}}
                <div class="mt-6 text-center">
                    <a href="{{ route('admin.login') }}" class="text-sm text-gray-400 hover:text-biper-pink transition inline-flex items-center gap-1.5">
                        <i class="fas fa-arrow-left text-xs"></i>
                        Ke halaman login
                    </a>
                </div>

            </div>
        </div>

    </div>

</body>

</html>
