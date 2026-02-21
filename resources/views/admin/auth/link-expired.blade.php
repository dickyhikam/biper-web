<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Kadaluarsa - Biper Baby Care</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-text.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-50 antialiased h-screen overflow-hidden">

    <div class="h-screen flex">

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
                        Admin Panel<br>Biper Baby Care
                    </h1>
                    <p class="text-white/60 text-sm leading-relaxed max-w-[280px]">
                        Kelola booking, layanan, dan operasional Biper Baby Spa dari satu tempat.
                    </p>
                </div>

                {{-- Footer --}}
                <p class="text-white/30 text-xs">&copy; {{ date('Y') }} Biper Baby Care</p>
            </div>
        </div>

        {{-- Right Panel --}}
        <div class="flex-1 flex items-center justify-center px-6">
            <div class="w-full max-w-[420px] text-center">

                {{-- Mobile Logo --}}
                <div class="lg:hidden flex justify-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Biper" class="w-16 h-16 rounded-2xl shadow-lg shadow-biper-pink/20">
                </div>

                {{-- Icon --}}
                <div class="mx-auto w-20 h-20 bg-red-50 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-link-slash text-3xl text-red-400"></i>
                </div>

                {{-- Header --}}
                <div class="flex justify-center mb-4">
                    <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-500 text-xs font-semibold px-3 py-1 rounded-full">
                        <i class="fas fa-clock text-[10px]"></i>
                        Link Kadaluarsa
                    </span>
                </div>

                <h2 class="font-display text-2xl font-bold text-gray-800 mb-2">Link Sudah Tidak Berlaku</h2>
                <p class="text-gray-400 text-sm leading-relaxed mb-8">
                    Link untuk membuat password sudah kadaluarsa atau sudah pernah digunakan. Silakan hubungi admin untuk mengirim ulang email undangan.
                </p>

                {{-- Actions --}}
                <a href="{{ route('admin.login') }}"
                   class="w-full inline-flex items-center justify-center bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white py-3 rounded-xl font-semibold shadow-lg shadow-biper-pink/25 hover:shadow-biper-pink/40 hover:-translate-y-0.5 transition-all duration-300 text-sm">
                    <i class="fas fa-arrow-right-to-bracket mr-2"></i>
                    Ke Halaman Login
                </a>

            </div>
        </div>

    </div>

</body>

</html>
