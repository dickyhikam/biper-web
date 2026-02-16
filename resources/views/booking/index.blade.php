<x-landing-page>
    <x-slot:title>Booking Online - Biper Baby Spa</x-slot:title>

    {{-- Hero Section --}}
    <div class="relative pt-32 pb-16 bg-gradient-to-br from-biper-pink-light/50 via-white to-biper-blue-light/30 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <span class="inline-block text-biper-pink font-bold tracking-widest text-xs uppercase mb-4 bg-white px-4 py-2 rounded-full shadow-sm border border-biper-pink/20">
                <i class="fas fa-calendar-alt mr-2"></i>Reservasi Online
            </span>
            <h1 class="font-display font-bold text-4xl md:text-5xl text-gray-800 mb-4 leading-tight">
                Booking <span class="text-transparent bg-clip-text bg-gradient-to-r from-biper-pink to-biper-blue">Mudah & Cepat</span>
            </h1>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                Pilih layanan, tentukan jadwal, dan amankan slot untuk si kecil dalam 3 langkah mudah.
            </p>
        </div>
    </div>

    {{-- Booking Form Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4" x-data="{
            step: 1,
            selectedService: null,
            selectedDate: '',
            selectedTime: '',
            isLoggedIn: {{ auth()->check() ? 'true' : 'false' }},
            bookingMode: 'guest', // 'guest' or 'user'
            selectedChild: null,
            savedChildren: [
                { id: 1, name: 'Muhammad Arkan', age: 6, mother: 'Sarah Amanda', phone: '081234567890' },
                { id: 2, name: 'Zahra Amelia', age: 12, mother: 'Sarah Amanda', phone: '081234567890' }
            ],
            services: [
                { id: 1, name: 'Biper Complete Spa', price: '150K', duration: '60 Menit', icon: 'fa-spa', color: 'biper-pink', desc: 'Baby Gym + Hydrotherapy + Massage' },
                { id: 2, name: 'Pediatric Massage', price: '120K', duration: '45 Menit', icon: 'fa-hands', color: 'biper-blue', desc: 'Pijat terapi khusus batuk pilek & kolik' },
                { id: 3, name: 'Baby Swim', price: '60K', duration: '20 Menit', icon: 'fa-swimmer', color: 'purple-600', desc: 'Renang air hangat dengan pelampung leher' },
                { id: 4, name: 'Home Care Visit', price: '135K', duration: '60 Menit', icon: 'fa-home', color: 'green-600', desc: 'Layanan ke rumah dengan peralatan lengkap' },
                { id: 5, name: 'Lactation Massage', price: '175K', duration: '60 Menit', icon: 'fa-spa', color: 'biper-pink', desc: 'Pijat ASI untuk melancarkan produksi' },
                { id: 6, name: 'Postpartum Massage', price: '200K', duration: '60 Menit', icon: 'fa-spa', color: 'biper-pink', desc: 'Pijat nifas pasca melahirkan' }
            ],
            init() {
                // Read URL parameter for auto-select service
                const urlParams = new URLSearchParams(window.location.search);
                const serviceId = urlParams.get('service');

                if (serviceId) {
                    const service = this.services.find(s => s.id == serviceId);
                    if (service) {
                        this.selectedService = service;
                        this.step = 2; // Auto skip to step 2 (pilih jadwal)
                    }
                }
            },
            timeSlots: ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'],
            formData: {
                babyName: '',
                babyAge: '',
                motherName: '',
                phone: '',
                notes: ''
            },
            // Calendar Data
            currentMonth: new Date().getMonth(),
            currentYear: new Date().getFullYear(),
            get daysInMonth() {
                return new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
            },
            get firstDayOfMonth() {
                return new Date(this.currentYear, this.currentMonth, 1).getDay();
            },
            get monthName() {
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                return months[this.currentMonth];
            },
            prevMonth() {
                if (this.currentMonth === 0) {
                    this.currentMonth = 11;
                    this.currentYear--;
                } else {
                    this.currentMonth--;
                }
            },
            nextMonth() {
                if (this.currentMonth === 11) {
                    this.currentMonth = 0;
                    this.currentYear++;
                } else {
                    this.currentMonth++;
                }
            },
            selectDate(day) {
                const date = new Date(this.currentYear, this.currentMonth, day);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (date < today) return; // Disable past dates

                // Fix timezone issue: use local date format instead of ISO
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const dayStr = String(date.getDate()).padStart(2, '0');
                this.selectedDate = `${year}-${month}-${dayStr}`;
            },
            isToday(day) {
                const today = new Date();
                return day === today.getDate() &&
                       this.currentMonth === today.getMonth() &&
                       this.currentYear === today.getFullYear();
            },
            isPastDate(day) {
                const date = new Date(this.currentYear, this.currentMonth, day);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                return date < today;
            },
            isSelectedDate(day) {
                if (!this.selectedDate) return false;
                const selected = new Date(this.selectedDate);
                return day === selected.getDate() &&
                       this.currentMonth === selected.getMonth() &&
                       this.currentYear === selected.getFullYear();
            },
            nextStep() {
                if (this.step < 4) this.step++;
            },
            prevStep() {
                if (this.step > 1) this.step--;
            },
            selectService(service) {
                this.selectedService = service;
                this.nextStep();
            },
            selectChild(child) {
                this.selectedChild = child;
                this.formData.babyName = child.name;
                this.formData.babyAge = child.age;
                this.formData.motherName = child.mother;
                this.formData.phone = child.phone;
            }
        }">

            {{-- Progress Stepper --}}
            <div class="mb-16">
                <div class="flex justify-center items-start max-w-4xl mx-auto px-4">
                    <template x-for="i in 4" :key="i">
                        <div class="flex items-start" :class="i < 4 ? 'flex-1' : ''">
                            {{-- Step Circle & Label --}}
                            <div class="flex flex-col items-center flex-shrink-0">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white transition-all duration-300 shadow-lg"
                                     :class="step >= i ? 'bg-gradient-to-r from-biper-pink to-biper-pink-dark scale-110' : 'bg-gray-300'">
                                    <span x-show="step > i"><i class="fas fa-check"></i></span>
                                    <span x-show="step <= i" x-text="i"></span>
                                </div>
                                <div class="mt-3 text-xs font-bold text-center w-24"
                                     :class="step >= i ? 'text-biper-pink' : 'text-gray-400'">
                                    <span x-show="i === 1">Pilih<br>Layanan</span>
                                    <span x-show="i === 2">Pilih<br>Jadwal</span>
                                    <span x-show="i === 3">Data<br>Diri</span>
                                    <span x-show="i === 4">Konfirmasi</span>
                                </div>
                            </div>

                            {{-- Connector Line --}}
                            <div x-show="i < 4" class="flex-1 h-1 mx-2 rounded transition-colors duration-300 mt-6"
                                 :class="step > i ? 'bg-biper-pink' : 'bg-gray-200'"></div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Step 1: Pilih Layanan --}}
            <div x-show="step === 1" x-transition class="space-y-6">
                <div class="text-center mb-8">
                    <h2 class="font-display font-bold text-2xl text-gray-800 mb-2">Pilih Layanan</h2>
                    <p class="text-gray-500">Pilih salah satu treatment yang Bunda inginkan untuk si kecil</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="service in services" :key="service.id">
                        <div @click="selectService(service)"
                             class="group cursor-pointer bg-white border-2 border-gray-100 rounded-[2rem] p-6 hover:border-biper-pink hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-lg shrink-0 transition-transform group-hover:scale-110"
                                     :class="'bg-' + service.color + '/10 text-' + service.color">
                                    <i :class="'fas ' + service.icon"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg text-gray-800 mb-1 font-display group-hover:text-biper-pink transition" x-text="service.name"></h3>
                                    <p class="text-sm text-gray-500 mb-3" x-text="service.desc"></p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xl font-bold text-biper-pink" x-text="'Rp ' + service.price"></span>
                                        <span class="text-xs bg-gray-100 px-3 py-1 rounded-full text-gray-600">
                                            <i class="far fa-clock mr-1"></i><span x-text="service.duration"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Step 2: Pilih Jadwal --}}
            <div x-show="step === 2" x-transition class="space-y-6">
                <div class="text-center mb-8">
                    <h2 class="font-display font-bold text-2xl text-gray-800 mb-2">Pilih Tanggal & Waktu</h2>
                    <p class="text-gray-500">Tentukan kapan Bunda ingin membawa si kecil</p>
                </div>

                <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-lg">
                    <div class="grid md:grid-cols-2 gap-8">
                        {{-- Custom Calendar Picker --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-4">
                                <i class="fas fa-calendar-day text-biper-pink mr-2"></i>Pilih Tanggal
                            </label>

                            {{-- Calendar Widget --}}
                            <div class="bg-gradient-to-br from-white to-gray-50 border-2 border-gray-200 rounded-2xl overflow-hidden shadow-lg">
                                {{-- Calendar Header --}}
                                <div class="bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-4 py-3 flex items-center justify-between">
                                    <button @click="prevMonth()" class="w-8 h-8 rounded-lg hover:bg-white/20 transition flex items-center justify-center">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <div class="font-bold text-lg" x-text="monthName + ' ' + currentYear"></div>
                                    <button @click="nextMonth()" class="w-8 h-8 rounded-lg hover:bg-white/20 transition flex items-center justify-center">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>

                                {{-- Calendar Days Header --}}
                                <div class="grid grid-cols-7 gap-1 px-3 py-2 bg-gray-100 text-xs font-bold text-gray-500">
                                    <div class="text-center">Min</div>
                                    <div class="text-center">Sen</div>
                                    <div class="text-center">Sel</div>
                                    <div class="text-center">Rab</div>
                                    <div class="text-center">Kam</div>
                                    <div class="text-center">Jum</div>
                                    <div class="text-center text-red-500">Sab</div>
                                </div>

                                {{-- Calendar Days Grid --}}
                                <div class="grid grid-cols-7 gap-1 p-3 bg-white">
                                    {{-- Empty cells for days before month starts --}}
                                    <template x-for="empty in firstDayOfMonth" :key="'empty-' + empty">
                                        <div class="aspect-square"></div>
                                    </template>

                                    {{-- Actual days --}}
                                    <template x-for="day in daysInMonth" :key="day">
                                        <button @click="selectDate(day)"
                                                :disabled="isPastDate(day)"
                                                class="aspect-square rounded-lg text-sm font-bold transition-all duration-200 relative"
                                                :class="{
                                                    'bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white shadow-lg scale-110': isSelectedDate(day),
                                                    'bg-biper-blue-light text-biper-blue ring-2 ring-biper-blue': isToday(day) && !isSelectedDate(day),
                                                    'hover:bg-biper-pink-light cursor-pointer': !isPastDate(day) && !isSelectedDate(day),
                                                    'text-gray-300 cursor-not-allowed': isPastDate(day)
                                                }"
                                                x-text="day">
                                        </button>
                                    </template>
                                </div>

                                {{-- Selected Date Display --}}
                                <div class="px-4 py-3 bg-gradient-to-r from-biper-pink-light to-biper-blue-light text-center" x-show="selectedDate">
                                    <p class="text-xs text-gray-600 mb-1">Tanggal Dipilih:</p>
                                    <p class="font-bold text-biper-pink" x-text="selectedDate ? new Date(selectedDate).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }) : '-'"></p>
                                </div>
                            </div>
                        </div>

                        {{-- Time Picker --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-4">
                                <i class="fas fa-clock text-biper-blue mr-2"></i>Pilih Waktu
                            </label>
                            <div class="grid grid-cols-4 gap-2">
                                <template x-for="time in timeSlots" :key="time">
                                    <button @click="selectedTime = time"
                                            class="px-3 py-3 text-sm font-bold rounded-xl border-2 transition-all duration-200"
                                            :class="selectedTime === time
                                                ? 'bg-gradient-to-r from-biper-blue to-biper-blue-dark text-white border-biper-blue shadow-lg scale-105'
                                                : 'bg-white text-gray-600 border-gray-200 hover:border-biper-blue hover:bg-biper-blue-light'"
                                            x-text="time"></button>
                                </template>
                            </div>

                            <div class="mt-6 p-4 bg-biper-blue-light rounded-xl border border-biper-blue/20">
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-info-circle text-biper-blue mr-2"></i>
                                    Jam operasional: <strong>Senin - Sabtu, 08:00 - 17:00 WIB</strong>. Booking H-1 minimal pukul 16:00.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button @click="prevStep()"
                            class="px-6 py-3 border-2 border-gray-200 text-gray-600 font-bold rounded-full hover:border-biper-blue hover:text-biper-blue transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </button>
                    <button @click="nextStep()"
                            :disabled="!selectedDate || !selectedTime"
                            :class="selectedDate && selectedTime ? 'bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white' : 'bg-gray-300 text-gray-500 cursor-not-allowed'"
                            class="flex-1 px-6 py-3 font-bold rounded-full transition shadow-lg">
                        Lanjut<i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            {{-- Step 3: Data Diri --}}
            <div x-show="step === 3" x-transition class="space-y-6">
                <div class="text-center mb-8">
                    <h2 class="font-display font-bold text-2xl text-gray-800 mb-2">
                        <span x-show="isLoggedIn">Pilih Data Anak</span>
                        <span x-show="!isLoggedIn">Lengkapi Data</span>
                    </h2>
                    <p class="text-gray-500" x-show="isLoggedIn">Pilih anak yang akan di-treatment oleh terapis kami</p>
                    <p class="text-gray-500" x-show="!isLoggedIn">Login untuk booking lebih cepat atau lanjutkan sebagai guest</p>
                </div>

                {{-- If NOT Logged In: Show Login/Guest Options --}}
                <div x-show="!isLoggedIn && bookingMode === 'guest'" class="space-y-6">
                    {{-- Login Prompt --}}
                    <div class="bg-gradient-to-br from-biper-blue-light to-biper-pink-light border-2 border-biper-blue/30 rounded-[2rem] p-8 text-center">
                        <div class="w-20 h-20 bg-gradient-to-r from-biper-blue to-biper-pink rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-4 shadow-xl">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2 font-display">Sudah Punya Akun?</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">Login untuk booking lebih cepat dengan data tersimpan, tracking riwayat, dan dapatkan poin reward!</p>

                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="/login" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-6 py-3 rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <i class="fas fa-sign-in-alt"></i>
                                Login / Register
                            </a>
                            <button @click="bookingMode = 'manual'" class="inline-flex items-center justify-center gap-2 bg-white border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-full font-bold hover:border-biper-blue hover:text-biper-blue transition-all duration-300">
                                <i class="fas fa-edit"></i>
                                Lanjut sebagai Guest
                            </button>
                        </div>

                        <div class="mt-6 flex items-center justify-center gap-4 text-xs text-gray-500">
                            <span class="flex items-center gap-1"><i class="fas fa-check-circle text-green-500"></i> Data Tersimpan</span>
                            <span class="flex items-center gap-1"><i class="fas fa-check-circle text-green-500"></i> Booking Cepat</span>
                            <span class="flex items-center gap-1"><i class="fas fa-check-circle text-green-500"></i> Poin Reward</span>
                        </div>
                    </div>
                </div>

                {{-- If Logged In: Show Saved Children Selection --}}
                <div x-show="isLoggedIn" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-4">
                        <template x-for="child in savedChildren" :key="child.id">
                            <div @click="selectChild(child)"
                                 class="group cursor-pointer bg-white border-2 rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                                 :class="selectedChild?.id === child.id ? 'border-biper-pink bg-gradient-to-br from-biper-pink-light/30 to-white shadow-lg' : 'border-gray-200 hover:border-biper-blue'">
                                <div class="flex items-start gap-4">
                                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shadow-md transition-transform group-hover:scale-110"
                                         :class="selectedChild?.id === child.id ? 'bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white' : 'bg-gray-100 text-gray-400'">
                                        <i class="fas fa-baby"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-lg text-gray-800 mb-1 font-display" x-text="child.name"></h3>
                                        <p class="text-sm text-gray-500 mb-2">
                                            <i class="far fa-calendar-alt mr-1"></i><span x-text="child.age + ' bulan'"></span>
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            <i class="fas fa-user mr-1"></i><span x-text="'Ibu: ' + child.mother"></span>
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-center w-6 h-6 rounded-full border-2 transition-colors"
                                         :class="selectedChild?.id === child.id ? 'border-biper-pink bg-biper-pink' : 'border-gray-300'">
                                        <i x-show="selectedChild?.id === child.id" class="fas fa-check text-white text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- Add New Child Card --}}
                        <div @click="bookingMode = 'manual'; selectedChild = null; formData = { babyName: '', babyAge: '', motherName: '', phone: '', notes: '' }"
                             class="group cursor-pointer bg-gradient-to-br from-gray-50 to-white border-2 border-dashed border-gray-300 rounded-2xl p-6 hover:border-biper-blue hover:bg-biper-blue-light/20 transition-all duration-300 flex items-center justify-center text-center">
                            <div>
                                <div class="w-16 h-16 bg-gray-100 group-hover:bg-biper-blue-light rounded-2xl flex items-center justify-center text-3xl text-gray-400 group-hover:text-biper-blue mx-auto mb-3 transition-all">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <h3 class="font-bold text-gray-600 group-hover:text-biper-blue transition-colors">Tambah Anak Baru</h3>
                                <p class="text-xs text-gray-400 mt-1">Isi data manual</p>
                            </div>
                        </div>
                    </div>

                    {{-- Notes for logged in users --}}
                    <div x-show="selectedChild" class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Khusus (Opsional)</label>
                        <textarea x-model="formData.notes" rows="3"
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition resize-none"
                                  placeholder="Contoh: Anak saya alergi parfum, mohon gunakan produk tanpa pewangi"></textarea>
                    </div>
                </div>

                {{-- Manual Form (Guest Mode or Adding New Child) --}}
                <div x-show="(!isLoggedIn && bookingMode === 'manual') || (isLoggedIn && bookingMode === 'manual')" class="space-y-6">
                    <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-lg space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Bayi/Anak *</label>
                                <input type="text" x-model="formData.babyName"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition"
                                       placeholder="Contoh: Muhammad Arkan">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Usia (Bulan) *</label>
                                <input type="number" x-model="formData.babyAge"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition"
                                       placeholder="Contoh: 6">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Ibu/Bunda *</label>
                                <input type="text" x-model="formData.motherName"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition"
                                       placeholder="Contoh: Sarah Amanda">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">No. WhatsApp *</label>
                                <input type="tel" x-model="formData.phone"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition"
                                       placeholder="08123456789">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Khusus (Opsional)</label>
                            <textarea x-model="formData.notes" rows="3"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition resize-none"
                                      placeholder="Contoh: Anak saya alergi parfum, mohon gunakan produk tanpa pewangi"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Navigation Buttons --}}
                <div class="flex gap-4">
                    <button @click="prevStep(); bookingMode = 'guest'; selectedChild = null;"
                            class="px-6 py-3 border-2 border-gray-200 text-gray-600 font-bold rounded-full hover:border-biper-blue hover:text-biper-blue transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </button>
                    <button @click="nextStep()"
                            :disabled="(!isLoggedIn && bookingMode === 'guest') || ((bookingMode === 'manual' || !isLoggedIn) && (!formData.babyName || !formData.babyAge || !formData.motherName || !formData.phone)) || (isLoggedIn && bookingMode !== 'manual' && !selectedChild)"
                            :class="(isLoggedIn && selectedChild) || (bookingMode === 'manual' && formData.babyName && formData.babyAge && formData.motherName && formData.phone)
                                ? 'bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white shadow-lg hover:shadow-xl'
                                : 'bg-gray-300 text-gray-500 cursor-not-allowed'"
                            class="flex-1 px-6 py-3 font-bold rounded-full transition">
                        Lanjut<i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            {{-- Step 4: Konfirmasi --}}
            <div x-show="step === 4" x-transition class="space-y-6">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center text-white text-4xl mx-auto mb-4 shadow-xl animate-bounce">
                        <i class="fas fa-check"></i>
                    </div>
                    <h2 class="font-display font-bold text-3xl text-gray-800 mb-2">Konfirmasi Booking</h2>
                    <p class="text-gray-500">Pastikan data Bunda sudah benar sebelum mengirim</p>
                </div>

                <div class="bg-gradient-to-br from-biper-pink-light/30 to-biper-blue-light/30 border border-biper-pink/20 rounded-[2rem] p-8 shadow-xl">
                    <div class="space-y-4">
                        <div class="flex items-start gap-4 pb-4 border-b border-gray-200">
                            <i class="fas fa-spa text-biper-pink text-2xl mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500">Layanan</p>
                                <p class="font-bold text-lg text-gray-800" x-text="selectedService?.name"></p>
                                <p class="text-biper-pink font-bold" x-text="'Rp ' + selectedService?.price"></p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 pb-4 border-b border-gray-200">
                            <i class="fas fa-calendar-alt text-biper-blue text-2xl mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500">Jadwal</p>
                                <p class="font-bold text-lg text-gray-800" x-text="new Date(selectedDate).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"></p>
                                <p class="text-biper-blue font-bold" x-text="'Pukul ' + selectedTime + ' WIB'"></p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 pb-4 border-b border-gray-200">
                            <i class="fas fa-baby text-purple-600 text-2xl mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500">Data Pasien</p>
                                <p class="font-bold text-lg text-gray-800" x-text="(selectedChild ? selectedChild.name : formData.babyName) + ' (' + (selectedChild ? selectedChild.age : formData.babyAge) + ' bulan)'"></p>
                                <p class="text-gray-600" x-text="'Ibu: ' + (selectedChild ? selectedChild.mother : formData.motherName)"></p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 pb-4 border-b border-gray-200">
                            <i class="fab fa-whatsapp text-green-600 text-2xl mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500">Kontak</p>
                                <p class="font-bold text-lg text-gray-800" x-text="selectedChild ? selectedChild.phone : formData.phone"></p>
                            </div>
                        </div>

                        <div x-show="formData.notes" class="flex items-start gap-4">
                            <i class="fas fa-sticky-note text-biper-yellow text-2xl mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500">Catatan Khusus</p>
                                <p class="text-gray-800" x-text="formData.notes"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4 flex items-start gap-3">
                    <i class="fas fa-exclamation-triangle text-yellow-600 text-xl mt-0.5"></i>
                    <div class="text-sm text-yellow-800">
                        <strong>Penting:</strong> Setelah booking, admin kami akan mengirim konfirmasi via WhatsApp dalam 5-10 menit. Mohon pastikan nomor Bunda aktif dan bisa dihubungi.
                    </div>
                </div>

                <div class="flex gap-4">
                    <button @click="prevStep()"
                            class="px-6 py-3 border-2 border-gray-200 text-gray-600 font-bold rounded-full hover:border-biper-blue hover:text-biper-blue transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </button>
                    <button @click="alert('Booking berhasil! (Fungsi submit akan diintegrasikan dengan backend)')"
                            class="flex-1 px-8 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-full shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 text-lg">
                        <i class="fab fa-whatsapp mr-2"></i>Kirim Booking via WhatsApp
                    </button>
                </div>
            </div>

        </div>
    </section>

    {{-- Trust Section --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-shield-check text-biper-pink text-3xl mb-3"></i>
                    <h3 class="font-bold text-gray-800 mb-2">Data Aman</h3>
                    <p class="text-sm text-gray-500">Informasi Bunda terenkripsi & dijaga kerahasiaannya</p>
                </div>
                <div class="text-center p-6 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-headset text-biper-blue text-3xl mb-3"></i>
                    <h3 class="font-bold text-gray-800 mb-2">Respon Cepat</h3>
                    <p class="text-sm text-gray-500">Admin siap membantu 24/7 via WhatsApp</p>
                </div>
                <div class="text-center p-6 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-undo-alt text-green-600 text-3xl mb-3"></i>
                    <h3 class="font-bold text-gray-800 mb-2">Reschedule Gratis</h3>
                    <p class="text-sm text-gray-500">Bisa ubah jadwal H-1 tanpa biaya tambahan</p>
                </div>
            </div>
        </div>
    </section>

</x-landing-page>
