<x-landing-page>
    <x-slot:title>{{ isset($anak) ? 'Edit Data Anak' : 'Tambah Anak' }} - Biper Baby Spa</x-slot:title>

    <div class="min-h-screen flex items-center justify-center py-32 px-4 bg-biper-pink-light/30 relative overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="w-full max-w-lg relative z-10" x-data="anakForm()" x-init="init()">

            <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-12">

                {{-- Icon --}}
                <div class="w-20 h-20 bg-gradient-to-r from-biper-blue to-biper-blue-dark rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-6 shadow-lg shadow-biper-blue/30">
                    <i class="fas {{ isset($anak) ? 'fa-pen' : 'fa-baby' }}"></i>
                </div>

                <h1 class="font-display font-bold text-3xl text-center text-gray-800 mb-2">
                    {{ isset($anak) ? 'Edit Data Anak' : 'Tambah Anak Baru' }}
                </h1>
                <p class="text-center text-gray-500 mb-8">
                    {{ isset($anak) ? 'Perbarui data anak Anda' : 'Tambahkan data anak untuk mempermudah proses booking' }}
                </p>

                {{-- Error Messages --}}
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

                {{-- Form --}}
                <form action="{{ isset($anak) ? route('anak.update', $anak) : route('anak.store') }}" method="POST" class="space-y-5">
                    @csrf
                    @if (isset($anak))
                        @method('PUT')
                    @endif

                    {{-- Nama Anak --}}
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-baby text-biper-pink mr-2"></i>Nama Anak
                        </label>
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama', $anak->nama ?? '') }}"
                            class="w-full px-4 py-3 border-2 {{ $errors->has('nama') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition"
                            placeholder="Contoh: Muhammad Arkan"
                            required>
                        @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir (Calendar Picker) --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-biper-pink mr-2"></i>Tanggal Lahir
                        </label>

                        <input type="hidden" name="tanggal_lahir" :value="selectedDate">

                        {{-- Trigger Input --}}
                        <div class="relative">
                            <button type="button" @click="calOpen = !calOpen"
                                class="w-full flex items-center justify-between px-4 py-3 border-2 rounded-xl transition text-left {{ $errors->has('tanggal_lahir') ? 'border-red-400' : 'border-gray-200' }}"
                                :class="calOpen ? 'border-biper-pink ring-2 ring-biper-pink/30' : (selectedDate ? 'border-biper-pink/50' : '')">
                                <span :class="selectedDate ? 'text-gray-800 font-medium' : 'text-gray-400'" x-text="selectedDate ? displayDate : 'Pilih tanggal lahir'"></span>
                                <i class="fas fa-calendar-days text-biper-pink"></i>
                            </button>

                            {{-- Calendar Popup --}}
                            <div x-show="calOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 -translate-y-2" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                @click.outside="calOpen = false"
                                class="absolute left-0 right-0 mt-2 bg-white rounded-2xl shadow-2xl border border-gray-100 p-5 z-50">

                                {{-- Header --}}
                                <div class="flex items-center justify-between mb-4">
                                    <button type="button" @click="calMode === 'days' ? calPrev() : (calMode === 'months' ? calYear-- : (calYearStart -= 12))"
                                        class="w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center text-gray-500 hover:text-biper-pink transition">
                                        <i class="fas fa-chevron-left text-xs"></i>
                                    </button>
                                    <div class="flex items-center gap-1">
                                        <button type="button" @click="calMode = calMode === 'months' ? 'days' : 'months'"
                                            class="font-bold text-gray-800 hover:text-biper-pink px-2 py-1 rounded-lg hover:bg-biper-pink-light/30 transition" x-text="calMonthNames[calMonth]"></button>
                                        <button type="button" @click="calMode = calMode === 'years' ? 'days' : 'years'"
                                            class="font-bold text-gray-500 hover:text-biper-pink px-2 py-1 rounded-lg hover:bg-biper-pink-light/30 transition" x-text="calYear"></button>
                                    </div>
                                    <button type="button" @click="calMode === 'days' ? calNext() : (calMode === 'months' ? calYear++ : (calYearStart += 12))"
                                        :disabled="calMode === 'days' && calIsNextDisabled()"
                                        :class="(calMode === 'days' && calIsNextDisabled()) ? 'text-gray-200 cursor-not-allowed' : 'text-gray-500 hover:text-biper-pink hover:bg-gray-100'"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center transition">
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </button>
                                </div>

                                {{-- MODE: Year Picker --}}
                                <div x-show="calMode === 'years'" class="grid grid-cols-3 gap-2">
                                    <template x-for="y in 12" :key="y">
                                        <button type="button"
                                            @click="calYear = calYearStart + y - 1; calMode = 'months'"
                                            :disabled="calYearStart + y - 1 > new Date().getFullYear()"
                                            :class="{
                                                'bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white font-bold shadow-md': calYear === calYearStart + y - 1,
                                                'text-gray-800 hover:bg-biper-pink-light/40': calYear !== calYearStart + y - 1 && calYearStart + y - 1 <= new Date().getFullYear(),
                                                'text-gray-200 cursor-not-allowed': calYearStart + y - 1 > new Date().getFullYear()
                                            }"
                                            class="py-2.5 rounded-xl text-sm font-medium transition-all"
                                            x-text="calYearStart + y - 1">
                                        </button>
                                    </template>
                                </div>

                                {{-- MODE: Month Picker --}}
                                <div x-show="calMode === 'months'" class="grid grid-cols-3 gap-2">
                                    <template x-for="(nama, idx) in calMonthShort" :key="idx">
                                        <button type="button"
                                            @click="calMonth = idx; calMode = 'days'"
                                            :disabled="calYear === new Date().getFullYear() && idx > new Date().getMonth()"
                                            :class="{
                                                'bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white font-bold shadow-md': calMonth === idx,
                                                'text-gray-800 hover:bg-biper-pink-light/40': calMonth !== idx && !(calYear === new Date().getFullYear() && idx > new Date().getMonth()),
                                                'text-gray-200 cursor-not-allowed': calYear === new Date().getFullYear() && idx > new Date().getMonth()
                                            }"
                                            class="py-2.5 rounded-xl text-sm font-medium transition-all"
                                            x-text="nama">
                                        </button>
                                    </template>
                                </div>

                                {{-- MODE: Day Picker --}}
                                <div x-show="calMode === 'days'">
                                    {{-- Day Names --}}
                                    <div class="grid grid-cols-7 mb-2">
                                        <div class="text-center text-[11px] font-semibold text-gray-400 py-1">Min</div>
                                        <div class="text-center text-[11px] font-semibold text-gray-400 py-1">Sen</div>
                                        <div class="text-center text-[11px] font-semibold text-gray-400 py-1">Sel</div>
                                        <div class="text-center text-[11px] font-semibold text-gray-400 py-1">Rab</div>
                                        <div class="text-center text-[11px] font-semibold text-gray-400 py-1">Kam</div>
                                        <div class="text-center text-[11px] font-semibold text-gray-400 py-1">Jum</div>
                                        <div class="text-center text-[11px] font-semibold text-gray-400 py-1">Sab</div>
                                    </div>

                                    {{-- Day Grid --}}
                                    <div class="grid grid-cols-7 gap-1">
                                        <template x-for="blank in calFirstDay" :key="'b'+blank">
                                            <div></div>
                                        </template>
                                        <template x-for="day in calDaysInMonth" :key="day">
                                            <button type="button"
                                                @click="calSelectDay(day)"
                                                :disabled="calIsFuture(day)"
                                                :class="{
                                                    'bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white shadow-md shadow-biper-pink/30 font-bold': calIsSelected(day),
                                                    'text-gray-800 hover:bg-biper-pink-light/40 font-medium': !calIsSelected(day) && !calIsFuture(day) && !calIsToday(day),
                                                    'bg-biper-blue-light/30 text-biper-blue-dark font-bold': calIsToday(day) && !calIsSelected(day),
                                                    'text-gray-200 cursor-not-allowed': calIsFuture(day)
                                                }"
                                                class="w-9 h-9 rounded-lg text-sm flex items-center justify-center transition-all duration-150 mx-auto"
                                                x-text="day">
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Preview usia --}}
                        <div x-show="selectedDate" x-transition class="mt-2 flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-biper-blue-light/30 text-biper-blue-dark text-xs font-semibold rounded-full">
                                <i class="fas fa-cake-candles"></i>
                                <span x-text="usiaText"></span>
                            </span>
                        </div>

                        @error('tanggal_lahir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-venus-mars text-biper-pink mr-2"></i>Jenis Kelamin
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="jenis_kelamin" value="L" class="hidden peer"
                                    {{ old('jenis_kelamin', $anak->jenis_kelamin ?? '') === 'L' ? 'checked' : '' }} required>
                                <div class="flex items-center gap-3 p-4 border-2 rounded-xl transition-all duration-200
                                    peer-checked:border-blue-400 peer-checked:bg-blue-50
                                    border-gray-200 hover:border-blue-300">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-500 flex items-center justify-center text-lg">
                                        <i class="fas fa-mars"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Laki-laki</span>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="jenis_kelamin" value="P" class="hidden peer"
                                    {{ old('jenis_kelamin', $anak->jenis_kelamin ?? '') === 'P' ? 'checked' : '' }} required>
                                <div class="flex items-center gap-3 p-4 border-2 rounded-xl transition-all duration-200
                                    peer-checked:border-pink-400 peer-checked:bg-pink-50
                                    border-gray-200 hover:border-pink-300">
                                    <div class="w-10 h-10 rounded-lg bg-pink-100 text-pink-500 flex items-center justify-center text-lg">
                                        <i class="fas fa-venus"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Perempuan</span>
                                </div>
                            </label>
                        </div>
                        @error('jenis_kelamin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-6 py-3.5 rounded-full font-semibold shadow-lg shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fas {{ isset($anak) ? 'fa-check' : 'fa-plus-circle' }} mr-2"></i>
                        {{ isset($anak) ? 'Simpan Perubahan' : 'Tambah Anak' }}
                    </button>
                </form>
            </div>

            {{-- Back to list --}}
            <div class="mt-6 text-center">
                <a href="{{ route('anak.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-biper-pink transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar Anak
                </a>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        function anakForm() {
            var existingDate = '{{ old("tanggal_lahir", isset($anak) ? $anak->tanggal_lahir->format("Y-m-d") : "") }}';
            var today = new Date();
            var initYear = today.getFullYear();
            var initMonth = today.getMonth();

            if (existingDate) {
                var parts = existingDate.split('-');
                initYear = parseInt(parts[0]);
                initMonth = parseInt(parts[1]) - 1;
            }

            return {
                calOpen: false,
                calMode: 'days',
                calYearStart: initYear - 5,
                selectedDate: existingDate,
                calYear: initYear,
                calMonth: initMonth,
                calMonthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                calMonthShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],

                get calFirstDay() {
                    return new Date(this.calYear, this.calMonth, 1).getDay();
                },

                get calDaysInMonth() {
                    return new Date(this.calYear, this.calMonth + 1, 0).getDate();
                },

                get displayDate() {
                    if (!this.selectedDate) return '';
                    var p = this.selectedDate.split('-');
                    return parseInt(p[2]) + ' ' + this.calMonthNames[parseInt(p[1]) - 1] + ' ' + p[0];
                },

                get usiaText() {
                    if (!this.selectedDate) return '';
                    var birth = new Date(this.selectedDate);
                    var now = new Date();
                    var months = (now.getFullYear() - birth.getFullYear()) * 12 + (now.getMonth() - birth.getMonth());
                    if (now.getDate() < birth.getDate()) months--;
                    if (months < 0) return '';
                    if (months < 1) return 'Baru lahir';
                    if (months < 12) return months + ' bulan';
                    var years = Math.floor(months / 12);
                    var rem = months % 12;
                    if (rem === 0) return years + ' tahun';
                    return years + ' tahun ' + rem + ' bulan';
                },

                calPrev() {
                    if (this.calMonth === 0) {
                        this.calMonth = 11;
                        this.calYear--;
                    } else {
                        this.calMonth--;
                    }
                },

                calNext() {
                    if (this.calIsNextDisabled()) return;
                    if (this.calMonth === 11) {
                        this.calMonth = 0;
                        this.calYear++;
                    } else {
                        this.calMonth++;
                    }
                },

                calIsNextDisabled() {
                    var now = new Date();
                    return this.calYear === now.getFullYear() && this.calMonth === now.getMonth();
                },

                calIsFuture(day) {
                    var now = new Date();
                    var d = new Date(this.calYear, this.calMonth, day);
                    return d > now;
                },

                calIsToday(day) {
                    var now = new Date();
                    return this.calYear === now.getFullYear() && this.calMonth === now.getMonth() && day === now.getDate();
                },

                calIsSelected(day) {
                    if (!this.selectedDate) return false;
                    var p = this.selectedDate.split('-');
                    return parseInt(p[0]) === this.calYear && parseInt(p[1]) - 1 === this.calMonth && parseInt(p[2]) === day;
                },

                calSelectDay(day) {
                    if (this.calIsFuture(day)) return;
                    var m = String(this.calMonth + 1).padStart(2, '0');
                    var d = String(day).padStart(2, '0');
                    this.selectedDate = this.calYear + '-' + m + '-' + d;
                    this.calOpen = false;
                },

                init() {}
            }
        }
    </script>
    @endpush

</x-landing-page>
