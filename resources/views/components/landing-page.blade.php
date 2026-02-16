<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Biper Baby Spa Sidoarjo' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-text.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Quicksand:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-700 bg-biper-pink-light/30 antialiased">

    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="block hover:opacity-80 transition-opacity duration-300">
                        <img src="{{ asset('images/logo.png') }}"
                            alt="Biper Baby Spa Sidoarjo"
                            class="h-12 w-auto object-contain">
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">

                    <a href="{{ route('pageHome') }}"
                        class="{{ request()->routeIs('pageHome') ? 'text-biper-pink font-bold' : 'text-gray-500 font-medium' }} hover:text-biper-pink transition">
                        Beranda
                    </a>

                    <a href="{{ route('pageLayanan') }}"
                        class="{{ request()->routeIs('pageLayanan') ? 'text-biper-pink font-bold' : 'text-gray-500 font-medium' }} hover:text-biper-pink transition">
                        Layanan
                    </a>

                    <a href="{{ route('pageTentang') }}"
                        class="{{ request()->routeIs('pageTentang') ? 'text-biper-pink font-bold' : 'text-gray-500 font-medium' }} hover:text-biper-pink transition">
                        Tentang
                    </a>

                    {{-- Login Link --}}
                    <a href="#" class="inline-flex items-center gap-2 text-gray-600 hover:text-biper-blue font-medium transition-colors group">
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center group-hover:bg-biper-blue-light transition-colors">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <span class="text-sm">Masuk</span>
                    </a>

                    {{-- Booking Online Button --}}
                    <a href="{{ route('pageBooking') }}" class="bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-6 py-2.5 rounded-full font-semibold shadow-lg shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:-translate-y-0.5 transition-all duration-300 inline-flex items-center gap-2">
                        <i class="fas fa-calendar-check"></i>
                        <span>Booking Online</span>
                    </a>

                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="relative bg-gray-900 text-white mt-20 pt-20 pb-10 overflow-hidden">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg shadow-biper-pink/20 overflow-hidden p-1.5">
                            <img src="{{ asset('images/logo-text.png') }}"
                                alt="Logo Biper"
                                class="w-full h-full object-contain">
                        </div>

                        <span class="font-display font-bold text-2xl text-white">
                            <span class="text-biper-blue">Sidoarjo</span>
                        </span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Mitra kesehatan dan kebahagiaan untuk Ibu dan Buah Hati. Melayani dengan hati, profesionalisme medis, dan kasih sayang sejak 2020.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-biper-pink hover:text-white transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-all duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-black hover:text-white hover:border hover:border-white/20 transition-all duration-300">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-display font-bold text-lg mb-6 text-white border-b-2 border-biper-pink w-max pb-2">Menu Utama</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li>
                            <a href="{{ url('/') }}" class="hover:text-biper-pink hover:translate-x-1 transition-all inline-block">
                                <i class="fas fa-chevron-right text-xs mr-2 text-biper-blue"></i>Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#layanan" class="hover:text-biper-pink hover:translate-x-1 transition-all inline-block">
                                <i class="fas fa-chevron-right text-xs mr-2 text-biper-blue"></i>Layanan
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/tentang') }}" class="hover:text-biper-pink hover:translate-x-1 transition-all inline-block">
                                <i class="fas fa-chevron-right text-xs mr-2 text-biper-blue"></i>Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-biper-pink hover:translate-x-1 transition-all inline-block">
                                <i class="fas fa-chevron-right text-xs mr-2 text-biper-blue"></i>Galeri Foto
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-display font-bold text-lg mb-6 text-white border-b-2 border-biper-blue w-max pb-2">Layanan Populer</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li>
                            <a href="#" class="hover:text-biper-blue hover:translate-x-1 transition-all inline-block">
                                <i class="fas fa-star text-xs mr-2 text-yellow-500"></i>Baby Spa Complete
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-biper-blue hover:translate-x-1 transition-all inline-block">
                                <i class="fas fa-star text-xs mr-2 text-yellow-500"></i>Pediatric Massage
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-biper-blue hover:translate-x-1 transition-all inline-block">
                                <i class="fas fa-star text-xs mr-2 text-yellow-500"></i>Home Care Visit
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-biper-blue hover:translate-x-1 transition-all inline-block">
                                <i class="fas fa-star text-xs mr-2 text-yellow-500"></i>Mom Treatment
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-display font-bold text-lg mb-6 text-white border-b-2 border-biper-yellow w-max pb-2">Tetap Terhubung</h4>
                    <p class="text-gray-400 text-sm mb-4">Dapatkan info promo dan tips kesehatan bayi setiap minggu.</p>
                    <form class="flex flex-col gap-3">
                        <input type="email" placeholder="Email Bunda..." class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-xl focus:outline-none focus:border-biper-pink text-sm text-white placeholder-gray-500 transition-colors">
                        <button class="w-full bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white font-bold py-3 rounded-xl hover:shadow-lg hover:shadow-biper-pink/20 transition-all">
                            Langganan <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>

            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">© {{ date('Y') }} <span class="text-white font-bold">Biper Baby Spa</span>. All rights reserved.</p>
                <div class="flex gap-6 text-sm text-gray-500">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 right-0 w-64 h-64 bg-biper-blue/10 rounded-full blur-3xl pointer-events-none translate-y-1/2 translate-x-1/2"></div>
    </footer>

    <a href="https://wa.me/628123456789" class="fixed bottom-8 right-8 w-16 h-16 bg-[#25d366] text-white rounded-full shadow-lg shadow-green-500/30 flex items-center justify-center text-3xl hover:scale-110 transition-transform z-50">
        <i class="fab fa-whatsapp"></i>
    </a>
</body>

</html>