<x-landing-page>
    <x-slot:title>Home - Biper Baby Spa Sidoarjo</x-slot:title>

    {{-- Slide data for Alpine.js (formatter-safe) --}}
    <div id="slidesData" class="hidden"
        data-slides="{{ json_encode($slides->map(fn ($s) => [
            'img' => $s->image_url ?: 'https://images.unsplash.com/photo-1519689680058-324335c77eba?w=1600&q=80',
            'title' => $s->title,
            'subtitle' => $s->subtitle ?? '',
            'cta' => $s->cta_text ?: 'Reservasi Sekarang',
            'cta_link' => $s->cta_link ?: '#booking',
            'color' => $s->overlay_class,
        ])->values()) }}">
    </div>

    <div x-data="{
        activeSlide: 0,
        slides: JSON.parse(document.getElementById('slidesData').dataset.slides),
        timer: null,
        next() {
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            this.resetTimer();
        },
        prev() {
            this.activeSlide = this.activeSlide === 0 ? this.slides.length - 1 : this.activeSlide - 1;
            this.resetTimer();
        },
        resetTimer() {
            clearInterval(this.timer);
            this.timer = setInterval(() => { this.next(); }, 6000);
        },
        init() { if (this.slides.length > 0) this.resetTimer(); }
    }" class="relative w-full h-[600px] lg:h-[750px] overflow-hidden group font-sans"
       x-show="slides.length > 0">

        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" class="absolute inset-0 w-full h-full">

                <div x-show="activeSlide === index"
                    x-transition:enter="transition transform duration-[6000ms] ease-out"
                    x-transition:enter-start="scale-100"
                    x-transition:enter-end="scale-110"
                    class="absolute inset-0 w-full h-full">
                    <img :src="slide.img" class="w-full h-full object-cover" alt="Slider Image">
                </div>

                <div class="absolute inset-0 bg-gradient-to-r via-black/20 to-transparent"
                    :class="slide.color">
                </div>

                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-6 sm:px-12 w-full">
                        <div class="max-w-2xl text-white">
                            <h1 x-show="activeSlide === index"
                                x-transition:enter="transition ease-out duration-700 delay-300"
                                x-transition:enter-start="opacity-0 translate-y-10"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-text="slide.title"
                                class="font-display font-bold text-5xl md:text-6xl lg:text-7xl mb-6 leading-tight drop-shadow-lg">
                            </h1>
                            <p x-show="activeSlide === index"
                                x-transition:enter="transition ease-out duration-700 delay-500"
                                x-transition:enter-start="opacity-0 translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-text="slide.subtitle"
                                class="text-lg md:text-xl text-white/90 mb-10 font-light leading-relaxed max-w-lg">
                            </p>
                            <div x-show="activeSlide === index"
                                x-transition:enter="transition ease-out duration-700 delay-700"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100">
                                <a :href="slide.cta_link"
                                    class="group inline-flex items-center gap-3 bg-white text-gray-900 px-8 py-4 rounded-full font-bold shadow-2xl hover:bg-biper-pink-light transition-all duration-300 transform hover:-translate-y-1">
                                    <span x-text="slide.cta"></span>
                                    <i class="fas fa-arrow-right text-biper-pink group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white hover:bg-white/30 transition-all duration-300 opacity-0 group-hover:opacity-100 -translate-x-full group-hover:translate-x-0">
            <i class="fas fa-chevron-left text-xl"></i>
        </button>
        <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white hover:bg-white/30 transition-all duration-300 opacity-0 group-hover:opacity-100 translate-x-full group-hover:translate-x-0">
            <i class="fas fa-chevron-right text-xl"></i>
        </button>

        <div class="absolute bottom-10 left-0 right-0 z-20 flex justify-center gap-3">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index; resetTimer()"
                    class="h-2 rounded-full transition-all duration-500 shadow-sm"
                    :class="activeSlide === index ? 'w-10 bg-biper-blue' : 'w-2 bg-white/50 hover:bg-white/80'">
                </button>
            </template>
        </div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[60px] md:h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="fill-biper-pink-light"></path>
            </svg>
        </div>
    </div>


    <section id="layanan" class="py-24 bg-biper-pink-light relative overflow-hidden">

        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-biper-pink/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-biper-blue/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block py-1 px-3 rounded-full bg-white text-biper-blue font-bold text-xs tracking-widest uppercase mb-4 shadow-sm">
                    Pilihan Bunda
                </span>
                <h2 class="font-display font-bold text-4xl md:text-5xl text-gray-800 mb-4">
                    Layanan Unggulan
                </h2>
                <p class="text-gray-500 text-lg">
                    Rangkaian perawatan medis dan relaksasi yang dirancang khusus untuk mendukung tumbuh kembang si kecil.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start lg:items-center">

                <div class="group bg-white rounded-[2rem] p-5 shadow-xl shadow-gray-100 border border-white hover:-translate-y-2 hover:shadow-2xl transition-all duration-300">
                    <div class="relative h-56 rounded-[1.5rem] overflow-hidden mb-6">
                        <div class="absolute inset-0 bg-biper-blue/10 group-hover:bg-transparent transition-colors z-10"></div>
                        <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="Pediatric Massage">
                        <div class="absolute top-3 right-3 z-20 bg-white/90 backdrop-blur text-gray-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            <i class="far fa-clock mr-1"></i> 45 Menit
                        </div>
                    </div>

                    <div class="px-2 pb-2">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="bg-biper-blue-light text-biper-blue text-[10px] font-bold px-2 py-1 rounded-md uppercase">Therapy</span>
                        </div>
                        <h3 class="font-display font-bold text-xl text-gray-800 mb-2 group-hover:text-biper-blue transition-colors">Pediatric Massage</h3>
                        <p class="text-gray-500 text-sm mb-6 line-clamp-2">
                            Terapi pijat khusus untuk batuk pilek (Tuina), kolik, susah makan, atau relaksasi bayi.
                        </p>

                        <div class="flex justify-between items-center border-t border-gray-50 pt-4">
                            <div>
                                <span class="block text-xs text-gray-400 line-through">Rp 150.000</span>
                                <span class="block text-xl font-bold text-biper-blue">Rp 120.000</span>
                            </div>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-biper-blue group-hover:text-white transition-all">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="relative bg-white rounded-[2.5rem] p-6 shadow-2xl shadow-biper-pink/10 border-2 border-biper-pink-light transform lg:scale-110 z-20">
                    <div class="absolute -top-5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg shadow-biper-pink/30 flex items-center gap-2">
                        <i class="fas fa-crown text-biper-yellow"></i> PALING LARIS
                    </div>

                    <div class="relative h-64 rounded-[2rem] overflow-hidden mb-6 shadow-inner">
                        <img src="https://images.unsplash.com/photo-1574482620826-40685ca5ebd2?w=600&q=80" class="w-full h-full object-cover" alt="Biper Complete Spa">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-biper-pink/80 to-transparent p-6 pt-12">
                            <span class="text-white font-bold text-lg">Paket Komplit</span>
                        </div>
                    </div>

                    <div class="text-center px-2">
                        <h3 class="font-display font-bold text-2xl text-gray-800 mb-2">Biper Complete Spa</h3>
                        <p class="text-gray-500 text-sm mb-6">
                            Kombinasi sempurna: Baby Gym + Hydrotherapy (Renang) + Massage Organik.
                        </p>

                        <div class="flex justify-center items-end gap-2 mb-6">
                            <span class="text-3xl font-bold text-biper-pink">Rp 150.000</span>
                            <span class="text-sm text-gray-400 line-through mb-2">Rp 185.000</span>
                        </div>

                        <a href="#" class="block w-full py-4 rounded-2xl bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white font-bold shadow-lg shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:scale-[1.02] transition-all duration-300">
                            Booking Slot Ini
                        </a>
                        <p class="text-xs text-gray-400 mt-3"><i class="fas fa-check-circle text-biper-blue mr-1"></i> Termasuk Sewa Handuk & Mainan</p>
                    </div>
                </div>

                <div class="group bg-white rounded-[2rem] p-5 shadow-xl shadow-gray-100 border border-white hover:-translate-y-2 hover:shadow-2xl transition-all duration-300">
                    <div class="relative h-56 rounded-[1.5rem] overflow-hidden mb-6">
                        <div class="absolute inset-0 bg-biper-blue/10 group-hover:bg-transparent transition-colors z-10"></div>
                        <img src="https://images.unsplash.com/photo-1600093463592-8e36ae95ef56?w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="Home Care">
                        <div class="absolute top-3 right-3 z-20 bg-white/90 backdrop-blur text-gray-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            <i class="fas fa-truck mr-1"></i> Visit
                        </div>
                    </div>

                    <div class="px-2 pb-2">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="bg-biper-blue-light text-biper-blue text-[10px] font-bold px-2 py-1 rounded-md uppercase">Premium</span>
                        </div>
                        <h3 class="font-display font-bold text-xl text-gray-800 mb-2 group-hover:text-biper-blue transition-colors">Home Care Visit</h3>
                        <p class="text-gray-500 text-sm mb-6 line-clamp-2">
                            Layanan premium datang ke rumah dengan membawa peralatan steril lengkap (kolam portable, dll).
                        </p>

                        <div class="flex justify-between items-center border-t border-gray-50 pt-4">
                            <div>
                                <span class="block text-xs text-biper-blue font-semibold bg-biper-blue-light px-2 py-0.5 rounded mb-1">Free Transport < 3KM</span>
                                        <span class="block text-xl font-bold text-biper-blue">Rp 135.000</span>
                            </div>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-biper-blue group-hover:text-white transition-all">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-16 text-center">
                <a href="#" class="inline-flex items-center justify-center gap-2 px-8 py-3 rounded-full border-2 border-biper-pink/20 text-gray-600 font-semibold hover:border-biper-pink hover:text-biper-pink hover:bg-white transition-all duration-300">
                    Lihat Seluruh Menu Layanan
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>

        </div>
    </section>

    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="font-display font-bold text-3xl md:text-4xl text-gray-800 mb-4">
                    Kenapa Harus <span class="text-biper-pink">Biper Sidoarjo?</span>
                </h2>
                <p class="text-gray-500">
                    Kami menggabungkan standar kesehatan medis dengan kenyamanan spa modern.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group p-8 rounded-[2rem] bg-biper-pink-light/30 border border-biper-pink-light hover:bg-white hover:shadow-xl hover:shadow-biper-pink/10 transition-all duration-300">
                    <div class="w-16 h-16 bg-white text-biper-pink rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                    <h3 class="font-display font-bold text-xl text-gray-800 mb-3">Bidan Tersertifikasi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Terapis kami bukan sekadar pemijat, tapi Bidan (Tenaga Kesehatan) yang paham anatomi & fisiologi bayi.
                    </p>
                </div>

                <div class="group p-8 rounded-[2rem] bg-biper-blue-light/50 border border-biper-blue-light hover:bg-white hover:shadow-xl hover:shadow-biper-blue/10 transition-all duration-300">
                    <div class="w-16 h-16 bg-white text-biper-blue rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        <i class="fas fa-shield-virus"></i>
                    </div>
                    <h3 class="font-display font-bold text-xl text-gray-800 mb-3">Steril & Higienis</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Kolam, mainan, dan alat spa selalu disterilkan dengan UVC & Ozone sebelum dan sesudah digunakan.
                    </p>
                </div>

                <div class="group p-8 rounded-[2rem] bg-biper-yellow-light border border-biper-yellow/20 hover:bg-white hover:shadow-xl hover:shadow-biper-yellow/10 transition-all duration-300">
                    <div class="w-16 h-16 bg-white text-biper-yellow rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="font-display font-bold text-xl text-gray-800 mb-3">Home Care Ready</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Hujan atau panas bukan halangan. Tim kami siap datang ke rumah Bunda lengkap dengan peralatan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gradient-to-br from-biper-blue to-biper-blue-dark relative overflow-hidden">

        <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-biper-pink/20 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10"
            x-data="{
            active: 0,
            interval: null,
            items: [
                {
                    name: 'Bunda Arkan',
                    loc: 'Sidoarjo Kota',
                    initial: 'BA',
                    text: 'Suka banget sama pelayanan Biper. Bidannya sabar banget handle anakku yang rewel pas renang. Pulang-pulang langsung tidur pules!'
                },
                {
                    name: 'Bunda Mikha',
                    loc: 'Candi, Sidoarjo',
                    initial: 'BM',
                    text: 'Fitur Homecare-nya juara! Pas ujan deres Bidan tetep dateng ontime, APD lengkap, alat steril. Sangat helpful buat new mom.'
                },
                {
                    name: 'Bunda Sarah',
                    loc: 'Waru, Sidoarjo',
                    initial: 'BS',
                    text: 'Tempatnya bersih, wangi, dan ramah anak. Mainannya banyak jadi anak gak bosen sebelum treatment. Recommended!'
                },
                {
                    name: 'Bunda Zea',
                    loc: 'Sukodono',
                    initial: 'BZ',
                    text: 'Baru pertama coba pijat tuina buat anak batuk pilek, alhamdulillah malemnya napas jadi lega dan tidurnya nyenyak.'
                },
                {
                    name: 'Bunda Kenzo',
                    loc: 'Gedangan',
                    initial: 'BK',
                    text: 'Admin fast respon banget pas booking. Terapisnya ramah, telaten, dan sabar. Anakku biasanya nangis ini malah ketawa-tawa.'
                },
                {
                    name: 'Bunda Rara',
                    loc: 'Krian',
                    initial: 'BR',
                    text: 'Terbaik di Sidoarjo! Harga terjangkau tapi pelayanannya kelas hotel. Bakal langganan terus di sini.'
                }
            ],
            init() {
                this.start();
            },
            start() {
                this.interval = setInterval(() => { this.next() }, 4000);
            },
            stop() {
                clearInterval(this.interval);
            },
            next() {
                // Logika: Jika di Desktop (lebar > 768) kurangi 3 item agar tidak blank di akhir
                let maxIndex = window.innerWidth >= 768 ? this.items.length - 3 : this.items.length - 1;
                this.active = this.active >= maxIndex ? 0 : this.active + 1;
            },
            prev() {
                let maxIndex = window.innerWidth >= 768 ? this.items.length - 3 : this.items.length - 1;
                this.active = this.active <= 0 ? maxIndex : this.active - 1;
            }
         }"
            x-init="init()"
            @mouseenter="stop()"
            @mouseleave="start()">

            <div class="text-center mb-16">
                <h2 class="font-display font-bold text-3xl md:text-4xl text-white mb-4">Kata Bunda Sidoarjo</h2>
                <p class="text-white/80">Ribuan bunda telah mempercayakan buah hatinya kepada kami.</p>
            </div>

            <div class="relative overflow-hidden w-full">

                <div class="flex transition-transform duration-700 ease-in-out"
                    :style="'transform: translateX(-' + (active * (window.innerWidth >= 768 ? 33.33 : 100)) + '%)'">

                    <template x-for="(item, index) in items" :key="index">
                        <div class="w-full md:w-1/3 flex-shrink-0 px-4">
                            <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-[2rem] text-white h-full hover:bg-white/15 transition-colors cursor-pointer">
                                <div class="flex text-biper-yellow mb-4 text-sm">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>

                                <p class="leading-relaxed mb-6 opacity-90 font-light italic h-24 overflow-hidden" x-text="'&quot;' + item.text + '&quot;'"></p>

                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center font-bold font-display" x-text="item.initial"></div>
                                    <div>
                                        <p class="font-bold text-sm" x-text="item.name"></p>
                                        <p class="text-xs opacity-70" x-text="item.loc"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                </div>
            </div>

            <div class="flex justify-center gap-2 mt-8">
                <template x-for="(item, index) in (window.innerWidth >= 768 ? items.length - 2 : items.length)" :key="index">
                    <button @click="active = index; stop(); start()"
                        class="h-2 rounded-full transition-all duration-300"
                        :class="active === index ? 'w-8 bg-biper-yellow' : 'w-2 bg-white/30 hover:bg-white/60'">
                    </button>
                </template>
            </div>

            <button @click="prev(); stop(); start()" class="hidden md:block absolute left-0 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white p-3 rounded-full backdrop-blur z-20">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button @click="next(); stop(); start()" class="hidden md:block absolute right-0 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white p-3 rounded-full backdrop-blur z-20">
                <i class="fas fa-chevron-right"></i>
            </button>

        </div>
    </section>

    <section id="lokasi" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-biper-pink-light/30 rounded-[3rem] p-8 md:p-12 border border-biper-pink-light flex flex-col lg:flex-row gap-12 items-center">

                <div class="w-full lg:w-1/2">
                    <h2 class="font-display font-bold text-3xl md:text-4xl text-gray-800 mb-6">Kunjungi Griya Biper</h2>

                    <ul class="space-y-6 mb-8">
                        <li class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-biper-pink shadow-md shrink-0">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-lg">Alamat</p>
                                <p class="text-gray-500">Jl. Pahlawan No. 123, Sidoarjo, Jawa Timur (Depan Alun-alun)</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-biper-blue shadow-md shrink-0">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-lg">Jam Operasional</p>
                                <p class="text-gray-500">Senin - Sabtu: 08.00 - 17.00 WIB</p>
                            </div>
                        </li>
                    </ul>

                    <div class="flex gap-4">
                        <a href="https://goo.gl/maps/..." target="_blank" class="inline-flex items-center gap-2 bg-gray-800 text-white px-6 py-3 rounded-full font-bold hover:bg-gray-700 transition shadow-lg">
                            <i class="fas fa-directions"></i> Petunjuk Arah
                        </a>
                        <a href="#" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-200 px-6 py-3 rounded-full font-bold hover:border-biper-pink hover:text-biper-pink transition shadow-sm">
                            <i class="fab fa-whatsapp"></i> Chat Admin
                        </a>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 h-80 lg:h-96 bg-gray-200 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-biper-pink/10 border-4 border-white">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.271387679383!2d112.715366!3d-7.445778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e6a575828d57%3A0x6e2671542387123!2sSidoarjo!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

</x-landing-page>