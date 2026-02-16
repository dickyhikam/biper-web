<x-landing-page>
    <x-slot:title>Tentang Kami - Biper Baby Spa</x-slot:title>

    {{-- Hero Section --}}
    <div class="relative pt-32 pb-24 bg-white overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-biper-pink-light/30 skew-y-3 origin-top-left -z-10 transform -translate-y-20"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-biper-blue/10 rounded-full blur-3xl translate-y-1/2 translate-x-1/2 animate-pulse"></div>
        <div class="absolute top-20 left-10 w-32 h-32 bg-biper-yellow/10 rounded-full blur-2xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-biper-pink font-bold tracking-widest text-xs uppercase bg-white px-4 py-2 rounded-full shadow-sm border border-biper-pink/20 mb-6 inline-block hover:scale-105 transition-transform duration-300">
                <i class="fas fa-heart mr-2"></i>Since 2020
            </span>
            <h1 class="font-display font-bold text-4xl md:text-6xl text-gray-800 mb-8 leading-tight">
                Lebih Dari Sekadar Spa,<br>
                Kami adalah <span class="text-transparent bg-clip-text bg-gradient-to-r from-biper-pink via-purple-600 to-biper-blue animate-gradient">Partner Kesehatan</span> Si Kecil
            </h1>
            <p class="text-gray-500 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
                Biper (Bidan Perawat) Baby Spa hadir untuk memberikan perawatan tumbuh kembang terbaik dengan standar medis yang ketat, namun tetap penuh kasih sayang seperti sentuhan Bunda sendiri.
            </p>
        </div>
    </div>

    {{-- Statistics Section --}}
    <section class="py-16 bg-gradient-to-r from-biper-pink to-biper-pink-dark relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS1vcGFjaXR5PSIwLjA1IiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 font-display group-hover:scale-110 transition-transform duration-300">5000+</div>
                    <p class="text-white/80 text-sm md:text-base font-medium">Bayi Dilayani</p>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 font-display group-hover:scale-110 transition-transform duration-300">98%</div>
                    <p class="text-white/80 text-sm md:text-base font-medium">Kepuasan Bunda</p>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 font-display group-hover:scale-110 transition-transform duration-300">12+</div>
                    <p class="text-white/80 text-sm md:text-base font-medium">Bidan Tersertifikasi</p>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 font-display group-hover:scale-110 transition-transform duration-300">4.9<i class="fas fa-star text-biper-yellow text-2xl ml-2"></i></div>
                    <p class="text-white/80 text-sm md:text-base font-medium">Rating Google</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Story Section with Enhanced Layout --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">

                {{-- Image Grid with Enhanced Effects --}}
                <div class="lg:w-1/2 grid grid-cols-2 gap-4 relative group">
                    {{-- Decorative Elements --}}
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-gradient-to-br from-biper-pink/20 to-biper-blue/20 rounded-full blur-xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-gradient-to-br from-biper-yellow/20 to-biper-pink/20 rounded-full blur-xl"></div>

                    {{-- Images with Stagger Effect --}}
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&q=80"
                         class="rounded-[2rem] shadow-xl w-full h-64 object-cover transform translate-y-8 group-hover:scale-105 transition-transform duration-500 ring-4 ring-white">
                    <img src="https://images.unsplash.com/photo-1519689680058-324335c77eba?w=600&q=80"
                         class="rounded-[2rem] shadow-xl w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500 ring-4 ring-white">

                    {{-- Floating Badge --}}
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-2xl shadow-2xl text-center border-4 border-biper-blue-light hover:rotate-3 transition-transform duration-300">
                        <span class="block text-5xl font-bold text-biper-blue font-display">5+</span>
                        <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Tahun<br>Pengalaman</span>
                    </div>
                </div>

                {{-- Story Content with Timeline --}}
                <div class="lg:w-1/2">
                    <span class="inline-block text-biper-blue font-bold tracking-widest text-xs uppercase mb-3 bg-biper-blue-light px-3 py-1 rounded-full">
                        <i class="fas fa-bookmark mr-2"></i>Cerita Kami
                    </span>
                    <h2 class="font-display font-bold text-3xl md:text-4xl text-gray-800 mb-6">
                        Berawal dari Kepedulian Bidan
                    </h2>

                    <div class="space-y-6 text-gray-600 leading-relaxed relative pl-6 border-l-2 border-biper-pink-light">
                        {{-- Timeline Dot --}}
                        <div class="absolute -left-[9px] top-2 w-4 h-4 rounded-full bg-biper-pink border-4 border-white shadow-md"></div>

                        <p class="relative">
                            <strong class="text-gray-800">2020:</strong> Biper Sidoarjo didirikan oleh sekelompok Bidan yang menyadari bahwa bayi membutuhkan lebih dari sekadar pijatan biasa. Bayi membutuhkan stimulasi motorik yang tepat dan penanganan kesehatan yang aman.
                        </p>

                        <div class="absolute -left-[9px] top-32 w-4 h-4 rounded-full bg-biper-blue border-4 border-white shadow-md"></div>

                        <p class="relative">
                            Kami melihat banyak orang tua khawatir membawa bayinya ke tempat spa biasa karena faktor <strong class="text-biper-blue">kebersihan</strong> dan <strong class="text-biper-blue">kualifikasi terapis</strong>.
                        </p>

                        <div class="absolute -left-[9px] top-64 w-4 h-4 rounded-full bg-biper-yellow border-4 border-white shadow-md"></div>

                        <div class="relative bg-gradient-to-r from-biper-pink-light to-biper-blue-light p-6 rounded-2xl border-l-4 border-biper-pink">
                            <i class="fas fa-quote-left text-biper-pink text-2xl mb-3 block opacity-50"></i>
                            <p class="font-medium text-gray-800 italic text-lg leading-relaxed">
                                "Maka, Biper lahir dengan janji: Seluruh terapis kami WAJIB tenaga kesehatan (Bidan/Perawat) dengan sertifikasi resmi."
                            </p>
                        </div>

                        <div class="absolute -left-[9px] bottom-12 w-4 h-4 rounded-full bg-green-500 border-4 border-white shadow-md animate-pulse"></div>

                        <p class="relative">
                            <strong class="text-gray-800">Hari ini:</strong> Kami telah melayani <strong class="text-biper-pink">ribuan bayi</strong> di Sidoarjo, membantu mereka tumbuh sehat, cerdas, dan ceria bersama keluarga yang bahagia.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Core Values Section - Enhanced --}}
    <section class="py-20 bg-gradient-to-b from-biper-blue-light/30 to-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-pink/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-blue/5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <span class="inline-block text-biper-blue font-bold tracking-widest text-xs uppercase mb-3 bg-white px-4 py-2 rounded-full shadow-sm">
                    <i class="fas fa-gem mr-2"></i>Our Values
                </span>
                <h2 class="font-display font-bold text-3xl md:text-4xl text-gray-800 mb-4">Nilai Utama Kami</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Tiga pilar yang menjadi fondasi pelayanan terbaik kami untuk si kecil</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Medical Standard --}}
                <div class="group bg-white p-8 rounded-[2rem] shadow-lg hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 relative overflow-hidden border-2 border-transparent hover:border-biper-pink/20">
                    {{-- Animated Background --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-biper-pink/0 to-biper-pink/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-biper-pink/10 to-biper-pink/20 rounded-2xl flex items-center justify-center text-biper-pink text-3xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500 shadow-lg">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-3 font-display group-hover:text-biper-pink transition-colors duration-300">Medical Standard</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Setiap prosedur mengacu pada standar kesehatan medis. Aman untuk bayi baru lahir (newborn) hingga balita.</p>
                        <div class="flex items-center gap-2 text-xs text-biper-pink font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <i class="fas fa-check-circle"></i>
                            <span>Certified & Trusted</span>
                        </div>
                    </div>
                </div>

                {{-- 100% Higienis --}}
                <div class="group bg-white p-8 rounded-[2rem] shadow-lg hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 relative overflow-hidden border-2 border-transparent hover:border-biper-blue/20">
                    {{-- Animated Background --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-biper-blue/0 to-biper-blue/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-biper-blue/10 to-biper-blue/20 rounded-2xl flex items-center justify-center text-biper-blue text-3xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500 shadow-lg">
                            <i class="fas fa-pump-soap"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-3 font-display group-hover:text-biper-blue transition-colors duration-300">100% Higienis</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Kami menerapkan sterilisasi ganda (UVC + Alkohol) pada kolam, mainan, dan matras setiap pergantian pasien.</p>
                        <div class="flex items-center gap-2 text-xs text-biper-blue font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <i class="fas fa-shield-virus"></i>
                            <span>Sterilisasi Ganda</span>
                        </div>
                    </div>
                </div>

                {{-- Edukasi Bunda --}}
                <div class="group bg-white p-8 rounded-[2rem] shadow-lg hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 relative overflow-hidden border-2 border-transparent hover:border-biper-yellow/30">
                    {{-- Animated Background --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-biper-yellow/0 to-biper-yellow/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-biper-yellow/10 to-biper-yellow/20 rounded-2xl flex items-center justify-center text-biper-yellow-dark text-3xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500 shadow-lg">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-3 font-display group-hover:text-biper-yellow-dark transition-colors duration-300">Edukasi Bunda</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Tidak hanya merawat bayi, kami juga mengedukasi Bunda tentang cara pijat bayi mandiri dan laktasi.</p>
                        <div class="flex items-center gap-2 text-xs text-biper-yellow-dark font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <i class="fas fa-book-reader"></i>
                            <span>Free Consultation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Team Section - Enhanced --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-biper-blue font-bold tracking-widest text-xs uppercase mb-2 block bg-biper-blue-light px-4 py-2 rounded-full inline-block">
                    <i class="fas fa-user-friends mr-2"></i>Tim Ahli Kami
                </span>
                <h2 class="font-display font-bold text-3xl md:text-4xl text-gray-800 mt-4">Kenalan dengan Bidan Biper</h2>
                <p class="text-gray-500 mt-4">Mereka yang siap merawat si kecil dengan tangan terampil dan hati yang tulus.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                {{-- Team Member 1 --}}
                <div class="group relative">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden bg-gray-100 mb-4 relative ring-4 ring-white shadow-xl group-hover:shadow-2xl transition-shadow duration-500">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=600&q=80"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 grayscale-[0.3] group-hover:grayscale-0">

                        {{-- Hover Overlay with Info --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-biper-pink via-biper-pink/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                            <div class="text-white text-xs space-y-2">
                                <p><i class="fas fa-briefcase mr-2"></i>8+ Tahun Pengalaman</p>
                                <p><i class="fas fa-baby mr-2"></i>2000+ Bayi Ditangani</p>
                                <p><i class="fas fa-certificate mr-2"></i>3 Sertifikasi Internasional</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-lg text-gray-800 font-display group-hover:text-biper-pink transition-colors">Bd. Sarah, S.Tr.Keb</h3>
                        <p class="text-biper-pink text-sm font-medium mb-2">Founder & Head Midwife</p>
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded-full uppercase tracking-wide shadow-sm">
                            <i class="fas fa-check-circle mr-1"></i>Certified Mom & Baby Spa
                        </span>
                    </div>
                </div>

                {{-- Team Member 2 --}}
                <div class="group relative">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden bg-gray-100 mb-4 relative ring-4 ring-white shadow-xl group-hover:shadow-2xl transition-shadow duration-500">
                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=600&q=80"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 grayscale-[0.3] group-hover:grayscale-0">

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-biper-blue via-biper-blue/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                            <div class="text-white text-xs space-y-2">
                                <p><i class="fas fa-briefcase mr-2"></i>6+ Tahun Pengalaman</p>
                                <p><i class="fas fa-baby mr-2"></i>1500+ Bayi Ditangani</p>
                                <p><i class="fas fa-award mr-2"></i>Best Therapist 2023</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-lg text-gray-800 font-display group-hover:text-biper-blue transition-colors">Bd. Rina, A.Md.Keb</h3>
                        <p class="text-biper-blue text-sm font-medium mb-2">Senior Therapist</p>
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded-full uppercase tracking-wide shadow-sm">
                            <i class="fas fa-check-circle mr-1"></i>Certified Pediatric Massage
                        </span>
                    </div>
                </div>

                {{-- Team Member 3 --}}
                <div class="group relative">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden bg-gray-100 mb-4 relative ring-4 ring-white shadow-xl group-hover:shadow-2xl transition-shadow duration-500">
                        <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=600&q=80"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 grayscale-[0.3] group-hover:grayscale-0">

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-600 via-purple-600/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                            <div class="text-white text-xs space-y-2">
                                <p><i class="fas fa-briefcase mr-2"></i>5+ Tahun Pengalaman</p>
                                <p><i class="fas fa-home mr-2"></i>Homecare Specialist</p>
                                <p><i class="fas fa-map-marker-alt mr-2"></i>Coverage Area 10KM+</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-lg text-gray-800 font-display group-hover:text-purple-600 transition-colors">Bd. Putri, A.Md.Keb</h3>
                        <p class="text-purple-600 text-sm font-medium mb-2">Homecare Specialist</p>
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded-full uppercase tracking-wide shadow-sm">
                            <i class="fas fa-check-circle mr-1"></i>STR Aktif
                        </span>
                    </div>
                </div>

                {{-- Team Member 4 --}}
                <div class="group relative">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden bg-gray-100 mb-4 relative ring-4 ring-white shadow-xl group-hover:shadow-2xl transition-shadow duration-500">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&q=80"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 grayscale-[0.3] group-hover:grayscale-0">

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-biper-pink via-biper-pink/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                            <div class="text-white text-xs space-y-2">
                                <p><i class="fas fa-briefcase mr-2"></i>7+ Tahun Pengalaman</p>
                                <p><i class="fas fa-baby mr-2"></i>Lactation Expert</p>
                                <p><i class="fas fa-star mr-2"></i>4.9/5.0 Rating Bunda</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-lg text-gray-800 font-display group-hover:text-biper-pink transition-colors">Bd. Anisa, S.Keb</h3>
                        <p class="text-biper-pink text-sm font-medium mb-2">Lactation Consultant</p>
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded-full uppercase tracking-wide shadow-sm">
                            <i class="fas fa-check-circle mr-1"></i>Certified Lactation
                        </span>
                    </div>
                </div>

            </div>

            {{-- Trust Badge --}}
            <div class="mt-16 text-center">
                <div class="inline-flex items-center gap-3 bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-3 rounded-full border border-green-200 shadow-sm">
                    <i class="fas fa-shield-alt text-green-600 text-xl"></i>
                    <span class="text-gray-700 font-medium text-sm">
                        <strong class="text-green-600">100% Tenaga Kesehatan Tersertifikasi</strong> dengan STR Aktif
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- Facilities Gallery - Enhanced --}}
    <section class="py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white overflow-hidden relative">
        {{-- Decorative Background --}}
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS1vcGFjaXR5PSIwLjAzIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-40"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <span class="inline-block text-biper-blue font-bold tracking-widest text-xs uppercase mb-3 bg-white/10 backdrop-blur px-3 py-1 rounded-full">
                        <i class="fas fa-images mr-2"></i>Our Space
                    </span>
                    <h2 class="font-display font-bold text-3xl md:text-4xl mt-2">Intip Fasilitas Kami</h2>
                    <p class="text-gray-400 mt-2">Nyaman, bersih, dan penuh warna untuk buah hati tercinta.</p>
                </div>
                <a href="#" class="hidden md:inline-flex items-center gap-2 text-biper-pink font-bold hover:text-white transition-colors duration-300 group mt-4 md:mt-0">
                    <span>Lihat Galeri Lengkap</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 h-96 md:h-[500px]">
                {{-- Main Featured Image --}}
                <div class="col-span-2 row-span-2 relative rounded-3xl overflow-hidden group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1519689680058-324335c77eba?w=800"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent group-hover:from-biper-pink/60 transition-colors duration-500"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="font-bold text-xl md:text-2xl font-display mb-2">Ruang Spa Utama</h3>
                                <p class="text-white/80 text-sm">Dilengkapi AC & aromatherapy</p>
                            </div>
                            <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center group-hover:bg-biper-pink transition-colors">
                                <i class="fas fa-search-plus text-sm"></i>
                            </div>
                        </div>
                    </div>
                    {{-- Featured Badge --}}
                    <div class="absolute top-4 right-4 bg-biper-yellow text-gray-900 px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                        <i class="fas fa-star mr-1"></i>Featured
                    </div>
                </div>

                {{-- Small Gallery Items --}}
                <div class="relative rounded-3xl overflow-hidden group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1600093463592-8e36ae95ef56?w=600"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent group-hover:from-biper-blue/60 transition-colors duration-500"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <p class="font-bold text-sm">Kolam Hydrotherapy</p>
                        <p class="text-white/70 text-xs mt-1">Air hangat steril</p>
                    </div>
                </div>

                <div class="relative rounded-3xl overflow-hidden group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=600"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent group-hover:from-purple-600/60 transition-colors duration-500"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <p class="font-bold text-sm">Ruang Massage</p>
                        <p class="text-white/70 text-xs mt-1">Private & cozy</p>
                    </div>
                </div>

                <div class="relative rounded-3xl overflow-hidden group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1555244162-803834f70033?w=600"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent group-hover:from-green-600/60 transition-colors duration-500"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <p class="font-bold text-sm">Ruang Tunggu</p>
                        <p class="text-white/70 text-xs mt-1">Wifi & TV tersedia</p>
                    </div>
                </div>

                <div class="relative rounded-3xl overflow-hidden group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1584634731339-252c581abfc5?w=600"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent group-hover:from-orange-600/60 transition-colors duration-500"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <p class="font-bold text-sm">Playground</p>
                        <p class="text-white/70 text-xs mt-1">Mainan edukatif</p>
                    </div>
                </div>
            </div>

            {{-- Feature Badges --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12">
                <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition-colors duration-300">
                    <i class="fas fa-pump-soap text-biper-blue text-2xl mb-2"></i>
                    <p class="text-sm font-bold">Sterilisasi UVC</p>
                </div>
                <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition-colors duration-300">
                    <i class="fas fa-snowflake text-biper-blue text-2xl mb-2"></i>
                    <p class="text-sm font-bold">Full AC</p>
                </div>
                <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition-colors duration-300">
                    <i class="fas fa-wifi text-biper-blue text-2xl mb-2"></i>
                    <p class="text-sm font-bold">Free Wifi</p>
                </div>
                <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition-colors duration-300">
                    <i class="fas fa-parking text-biper-blue text-2xl mb-2"></i>
                    <p class="text-sm font-bold">Parkir Luas</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section - Enhanced --}}
    <section class="py-24 bg-gradient-to-br from-white via-biper-pink-light/20 to-white relative overflow-hidden">
        {{-- Decorative Elements --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-pink/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-blue/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="max-w-5xl mx-auto px-4 text-center relative z-10">
            {{-- Icon Grid Background --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                <div class="grid grid-cols-3 gap-8 text-6xl text-biper-pink">
                    <i class="fas fa-baby"></i>
                    <i class="fas fa-heart"></i>
                    <i class="fas fa-hands-helping"></i>
                </div>
            </div>

            <div class="relative">
                <span class="inline-block text-biper-pink font-bold tracking-widest text-xs uppercase mb-4 bg-white px-4 py-2 rounded-full shadow-sm border border-biper-pink/20">
                    <i class="fas fa-phone-alt mr-2"></i>Hubungi Kami
                </span>

                <h2 class="font-display font-bold text-3xl md:text-5xl text-gray-800 mb-6 leading-tight">
                    Siap Memberikan yang Terbaik<br>
                    untuk <span class="text-transparent bg-clip-text bg-gradient-to-r from-biper-pink to-biper-blue">Buah Hati</span>?
                </h2>

                <p class="text-gray-500 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                    Konsultasikan kebutuhan si kecil dengan Bidan kami sekarang. <strong class="text-biper-pink">Gratis konsultasi awal</strong> via WhatsApp. Kami siap membantu Bunda 24/7.
                </p>

                {{-- Feature Pills --}}
                <div class="flex flex-wrap justify-center gap-3 mb-10">
                    <span class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full text-sm text-gray-600 shadow-sm border border-gray-100">
                        <i class="fas fa-check-circle text-green-500"></i>Respon Cepat
                    </span>
                    <span class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full text-sm text-gray-600 shadow-sm border border-gray-100">
                        <i class="fas fa-check-circle text-green-500"></i>Bidan Profesional
                    </span>
                    <span class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full text-sm text-gray-600 shadow-sm border border-gray-100">
                        <i class="fas fa-check-circle text-green-500"></i>Harga Transparan
                    </span>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="https://wa.me/628123456789?text=Halo%20Biper%2C%20saya%20ingin%20konsultasi%20tentang%20perawatan%20bayi"
                       class="group inline-flex items-center justify-center gap-3 bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:-translate-y-1 transition-all duration-300">
                        <i class="fab fa-whatsapp text-2xl group-hover:scale-110 transition-transform"></i>
                        <div class="text-left">
                            <div class="text-xs opacity-90">Chat Langsung</div>
                            <div>Konsultasi Gratis</div>
                        </div>
                    </a>

                    <a href="{{ route('pageLayanan') }}"
                       class="inline-flex items-center justify-center gap-3 bg-white border-2 border-biper-blue text-biper-blue px-8 py-4 rounded-full font-bold shadow-lg hover:bg-biper-blue hover:text-white hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-th-list"></i>
                        <span>Lihat Layanan</span>
                    </a>
                </div>

                {{-- Trust Indicators --}}
                <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-6 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-shield-alt text-green-500"></i>
                        <span>Tenaga Medis Tersertifikasi</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-star text-biper-yellow"></i>
                        <span>4.9/5.0 Rating</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-users text-biper-blue"></i>
                        <span>5000+ Bunda Puas</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-landing-page>