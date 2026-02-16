<x-landing-page>
    <x-slot:title>Verifikasi Email - Biper Baby Spa</x-slot:title>

    <div class="min-h-screen flex items-center justify-center py-32 px-4 bg-biper-pink-light/30 relative overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="w-full max-w-md relative z-10" x-data="verifyCode()">

            <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-12">

                {{-- Icon --}}
                <div class="w-20 h-20 bg-gradient-to-r from-biper-pink to-biper-pink-dark rounded-full flex items-center justify-center text-white text-3xl mx-auto mb-6 shadow-lg shadow-biper-pink/30">
                    <i class="fas fa-envelope-circle-check"></i>
                </div>

                <h1 class="font-display font-bold text-3xl text-center text-gray-800 mb-2">Verifikasi Email</h1>
                <p class="text-center text-gray-500 mb-8">
                    Masukkan kode 6 digit yang telah dikirim ke
                    <br>
                    <span class="font-semibold text-gray-700">{{ auth()->user()->email }}</span>
                </p>

                {{-- Success Message --}}
                @if (session('message'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-start gap-3">
                        <i class="fas fa-check-circle text-lg mt-0.5"></i>
                        <span>{{ session('message') }}</span>
                    </div>
                @endif

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

                <form x-ref="form" action="{{ route('verification.verify') }}" method="POST">
                    @csrf

                    {{-- Hidden input --}}
                    <input type="hidden" name="code" :value="fullCode">

                    {{-- 6 Code Input Boxes --}}
                    <div class="flex justify-center gap-3 mb-8">
                        <input id="code-0" type="text" maxlength="1" x-model="code[0]"
                            @input="onInput(0)" @keydown="onKeydown(0, $event)"
                            @paste.prevent="onPaste($event)" @focus="$event.target.select()"
                            class="w-12 h-14 text-center text-2xl font-bold border-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-biper-pink/30 transition-all duration-200 uppercase"
                            :class="code[0] ? 'bg-biper-pink-light/20 border-biper-pink text-biper-pink-dark' : 'border-gray-200 text-gray-800 focus:border-biper-pink'"
                            autocomplete="off">

                        <input id="code-1" type="text" maxlength="1" x-model="code[1]"
                            @input="onInput(1)" @keydown="onKeydown(1, $event)"
                            @paste.prevent="onPaste($event)" @focus="$event.target.select()"
                            class="w-12 h-14 text-center text-2xl font-bold border-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-biper-pink/30 transition-all duration-200 uppercase"
                            :class="code[1] ? 'bg-biper-pink-light/20 border-biper-pink text-biper-pink-dark' : 'border-gray-200 text-gray-800 focus:border-biper-pink'"
                            autocomplete="off">

                        <input id="code-2" type="text" maxlength="1" x-model="code[2]"
                            @input="onInput(2)" @keydown="onKeydown(2, $event)"
                            @paste.prevent="onPaste($event)" @focus="$event.target.select()"
                            class="w-12 h-14 text-center text-2xl font-bold border-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-biper-pink/30 transition-all duration-200 uppercase"
                            :class="code[2] ? 'bg-biper-pink-light/20 border-biper-pink text-biper-pink-dark' : 'border-gray-200 text-gray-800 focus:border-biper-pink'"
                            autocomplete="off">

                        <input id="code-3" type="text" maxlength="1" x-model="code[3]"
                            @input="onInput(3)" @keydown="onKeydown(3, $event)"
                            @paste.prevent="onPaste($event)" @focus="$event.target.select()"
                            class="w-12 h-14 text-center text-2xl font-bold border-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-biper-pink/30 transition-all duration-200 uppercase"
                            :class="code[3] ? 'bg-biper-pink-light/20 border-biper-pink text-biper-pink-dark' : 'border-gray-200 text-gray-800 focus:border-biper-pink'"
                            autocomplete="off">

                        <input id="code-4" type="text" maxlength="1" x-model="code[4]"
                            @input="onInput(4)" @keydown="onKeydown(4, $event)"
                            @paste.prevent="onPaste($event)" @focus="$event.target.select()"
                            class="w-12 h-14 text-center text-2xl font-bold border-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-biper-pink/30 transition-all duration-200 uppercase"
                            :class="code[4] ? 'bg-biper-pink-light/20 border-biper-pink text-biper-pink-dark' : 'border-gray-200 text-gray-800 focus:border-biper-pink'"
                            autocomplete="off">

                        <input id="code-5" type="text" maxlength="1" x-model="code[5]"
                            @input="onInput(5)" @keydown="onKeydown(5, $event)"
                            @paste.prevent="onPaste($event)" @focus="$event.target.select()"
                            class="w-12 h-14 text-center text-2xl font-bold border-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-biper-pink/30 transition-all duration-200 uppercase"
                            :class="code[5] ? 'bg-biper-pink-light/20 border-biper-pink text-biper-pink-dark' : 'border-gray-200 text-gray-800 focus:border-biper-pink'"
                            autocomplete="off">
                    </div>

                    {{-- Verify Button --}}
                    <button
                        type="submit"
                        :disabled="!isComplete"
                        :class="isComplete
                            ? 'bg-gradient-to-r from-biper-pink to-biper-pink-dark shadow-lg shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:-translate-y-0.5'
                            : 'bg-gray-300 cursor-not-allowed'"
                        class="w-full text-white px-6 py-3.5 rounded-full font-semibold transition-all duration-300"
                    >
                        <i class="fas fa-check-circle mr-2"></i>Verifikasi
                    </button>
                </form>

                {{-- Resend Code with Countdown --}}
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <p class="text-sm text-gray-500 text-center mb-3">Tidak menerima kode?</p>

                    <div class="text-center">
                        {{-- Countdown text --}}
                        <p x-show="countdown > 0" class="text-sm text-gray-400 mb-2">
                            Kirim ulang dalam
                            <span class="font-bold text-biper-pink" x-text="countdown"></span> detik
                        </p>

                        <form action="{{ route('verification.resend') }}" method="POST" class="inline">
                            @csrf
                            <button
                                type="submit"
                                :disabled="countdown > 0"
                                :class="countdown > 0
                                    ? 'text-gray-300 cursor-not-allowed'
                                    : 'text-biper-pink hover:text-biper-pink-dark'"
                                class="font-semibold text-sm inline-flex items-center gap-2 transition"
                                @click="countdown > 0 ? $event.preventDefault() : resetCountdown()"
                            >
                                <i class="fas fa-rotate"></i>
                                Kirim Ulang Kode
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Help --}}
                <div class="mt-6 p-3 bg-gray-50 rounded-xl">
                    <p class="text-xs text-gray-500 text-center">
                        <i class="fas fa-info-circle text-biper-blue mr-1"></i>
                        Periksa folder spam jika tidak menemukan email verifikasi
                    </p>
                </div>

            </div>

            {{-- Logout --}}
            <div class="mt-6 text-center">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-biper-pink transition">
                        <i class="fas fa-arrow-left"></i>
                        Keluar
                    </button>
                </form>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        function verifyCode() {
            return {
                code: ['', '', '', '', '', ''],
                countdown: 60,
                timer: null,

                get fullCode() {
                    return this.code.join('');
                },

                get isComplete() {
                    return this.fullCode.length === 6;
                },

                init() {
                    this.startCountdown();
                    this.$nextTick(() => {
                        document.getElementById('code-0').focus();
                    });
                },

                startCountdown() {
                    this.timer = setInterval(() => {
                        if (this.countdown > 0) {
                            this.countdown--;
                        } else {
                            clearInterval(this.timer);
                        }
                    }, 1000);
                },

                resetCountdown() {
                    clearInterval(this.timer);
                    this.countdown = 60;
                    this.startCountdown();
                },

                onInput(index) {
                    this.code[index] = this.code[index].toUpperCase().replace(/[^A-Z0-9]/g, '');

                    if (this.code[index] && index < 5) {
                        document.getElementById('code-' + (index + 1)).focus();
                    }

                    if (this.isComplete) {
                        this.$refs.form.submit();
                    }
                },

                onKeydown(index, event) {
                    if (event.key === 'Backspace' && !this.code[index] && index > 0) {
                        document.getElementById('code-' + (index - 1)).focus();
                    }
                },

                onPaste(event) {
                    var text = event.clipboardData.getData('text').toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 6);

                    for (var i = 0; i < text.length; i++) {
                        this.code[i] = text[i];
                    }

                    if (text.length > 0) {
                        var focusIndex = Math.min(text.length, 5);
                        document.getElementById('code-' + focusIndex).focus();
                    }

                    if (this.isComplete) {
                        this.$nextTick(() => this.$refs.form.submit());
                    }
                }
            }
        }
    </script>
    @endpush

</x-landing-page>
