<x-landing-page>
    <x-slot:title>Edit Profil - Biper Baby Spa</x-slot:title>

    <div class="min-h-screen flex items-center justify-center py-32 px-4 bg-biper-pink-light/30 relative overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-biper-blue/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-biper-pink/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <div class="w-full max-w-lg relative z-10" x-data="{
            showCurrentPassword: false,
            showNewPassword: false,
            showConfirmPassword: false,
            showPasswordForm: false
        }">

            <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-12">

                {{-- Avatar --}}
                <div class="w-20 h-20 bg-gradient-to-r from-biper-pink to-biper-blue rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-6 shadow-lg shadow-biper-pink/30">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <h1 class="font-display font-bold text-3xl text-center text-gray-800 mb-2">Edit Profil</h1>
                <p class="text-center text-gray-500 mb-8">Perbarui informasi akun Anda</p>

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

                {{-- Profile Form --}}
                <form action="{{ route('profil.update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Nickname + Name --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user text-biper-pink mr-2"></i>Panggilan & Nama Lengkap
                        </label>
                        <div class="flex gap-3">
                            <select
                                name="nickname"
                                class="w-28 shrink-0 px-3 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition bg-white text-gray-700 font-medium">
                                @foreach (\App\Models\User::NICKNAMES as $nick)
                                <option value="{{ $nick }}" {{ old('nickname', $user->nickname) === $nick ? 'selected' : '' }}>{{ $nick }}</option>
                                @endforeach
                            </select>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                class="flex-1 px-4 py-3 border-2 {{ $errors->has('name') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition"
                                placeholder="Nama lengkap"
                                required>
                        </div>
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email (read-only) --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-biper-pink mr-2"></i>Email
                        </label>
                        <div class="flex items-center gap-2">
                            <input
                                type="email"
                                value="{{ $user->email }}"
                                class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-500 cursor-not-allowed"
                                disabled>
                            @if ($user->hasVerifiedEmail())
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-50 text-green-600 text-xs font-semibold rounded-full flex-shrink-0">
                                <i class="fas fa-check-circle"></i> Terverifikasi
                            </span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Email tidak dapat diubah</p>
                    </div>

                    {{-- Phone/WhatsApp --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fab fa-whatsapp text-biper-pink mr-2"></i>No. WhatsApp
                        </label>
                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone', $user->phone) }}"
                            class="w-full px-4 py-3 border-2 {{ $errors->has('phone') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition"
                            placeholder="081234567890"
                            required>
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Save Profile Button --}}
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-biper-pink to-biper-pink-dark text-white px-6 py-3.5 rounded-full font-semibold shadow-lg shadow-biper-pink/30 hover:shadow-biper-pink/50 hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fas fa-check mr-2"></i>Simpan Perubahan
                    </button>
                </form>

                {{-- Divider --}}
                <div class="flex items-center gap-3 my-8">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Keamanan</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                {{-- Change Password Toggle --}}
                <button
                    type="button"
                    @click="showPasswordForm = !showPasswordForm"
                    class="w-full flex items-center justify-between p-4 border-2 border-gray-200 rounded-xl hover:border-biper-pink/50 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-biper-blue-light/30 text-biper-blue-dark flex items-center justify-center">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-semibold text-gray-700">Ubah Password</p>
                            <p class="text-xs text-gray-400">Ganti password akun Anda</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform" :class="showPasswordForm && 'rotate-180'"></i>
                </button>

                {{-- Password Form --}}
                <div x-show="showPasswordForm" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-4">
                    <form action="{{ route('profil.password') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        {{-- Current Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Lama</label>
                            <div class="relative">
                                <input
                                    :type="showCurrentPassword ? 'text' : 'password'"
                                    name="current_password"
                                    class="w-full px-4 py-3 border-2 {{ $errors->has('current_password') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition pr-12"
                                    placeholder="Masukkan password lama"
                                    required>
                                <button type="button" @click="showCurrentPassword = !showCurrentPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-biper-pink transition">
                                    <i :class="showCurrentPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </button>
                            </div>
                            @error('current_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                            <div class="relative">
                                <input
                                    :type="showNewPassword ? 'text' : 'password'"
                                    name="password"
                                    class="w-full px-4 py-3 border-2 {{ $errors->has('password') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:border-biper-pink focus:outline-none transition pr-12"
                                    placeholder="Minimal 8 karakter"
                                    required>
                                <button type="button" @click="showNewPassword = !showNewPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-biper-pink transition">
                                    <i :class="showNewPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </button>
                            </div>
                            @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm New Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <input
                                    :type="showConfirmPassword ? 'text' : 'password'"
                                    name="password_confirmation"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-biper-pink focus:outline-none transition pr-12"
                                    placeholder="Ketik ulang password baru"
                                    required>
                                <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-biper-pink transition">
                                    <i :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Save Password Button --}}
                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-biper-blue to-biper-blue-dark text-white px-6 py-3.5 rounded-full font-semibold shadow-lg shadow-biper-blue/30 hover:shadow-biper-blue/50 hover:-translate-y-0.5 transition-all duration-300">
                            <i class="fas fa-lock mr-2"></i>Ubah Password
                        </button>
                    </form>
                </div>

            </div>

            {{-- Back --}}
            <div class="mt-6 text-center">
                <a href="{{ route('pageHome') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-biper-pink transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>

</x-landing-page>
