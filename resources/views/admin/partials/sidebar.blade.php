<aside class="sidebar">
    <button type="button" class="sidebar-close-btn !mt-4">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
            <img src="{{ asset('images/logo-text.png') }}" alt="Biper" class="light-logo">
            <img src="{{ asset('images/logo-text.png') }}" alt="Biper" class="dark-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Biper" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">

            <li class="sidebar-menu-group-title">Menu Utama</li>

            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active-page' : '' }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-menu-group-title">Manajemen</li>

            <li>
                <a href="javascript:void(0)" class="opacity-50 pointer-events-none">
                    <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                    <span>Booking</span>
                    <span class="bg-neutral-200 dark:bg-neutral-600 text-neutral-500 dark:text-neutral-400 text-[10px] font-semibold px-1.5 py-0.5 rounded-full ms-auto">Soon</span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0)" class="opacity-50 pointer-events-none">
                    <iconify-icon icon="solar:hand-stars-outline" class="menu-icon"></iconify-icon>
                    <span>Layanan</span>
                    <span class="bg-neutral-200 dark:bg-neutral-600 text-neutral-500 dark:text-neutral-400 text-[10px] font-semibold px-1.5 py-0.5 rounded-full ms-auto">Soon</span>
                </a>
            </li>

            @auth('admin')
                @if (auth('admin')->user()->canViewUsers())
                    <li>
                        <a href="{{ route('admin.pelanggan.index') }}" class="{{ request()->routeIs('admin.pelanggan.*') ? 'active-page' : '' }}">
                            <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                            <span>Pelanggan</span>
                        </a>
                    </li>
                @endif
            @endauth

            @auth('admin')
                @if (auth('admin')->user()->canViewBidans())
                    <li>
                        <a href="{{ route('admin.bidans.index') }}" class="{{ request()->routeIs('admin.bidans.*') ? 'active-page' : '' }}">
                            <iconify-icon icon="solar:user-hands-outline" class="menu-icon"></iconify-icon>
                            <span>Bidan / Terapis</span>
                        </a>
                    </li>
                @endif
            @endauth

            <li class="sidebar-menu-group-title">Konten Website</li>

            @auth('admin')
                @if (auth('admin')->user()->canViewSlides())
                    <li>
                        <a href="{{ route('admin.slides.index') }}" class="{{ request()->routeIs('admin.slides.*') ? 'active-page' : '' }}">
                            <iconify-icon icon="solar:gallery-minimalistic-outline" class="menu-icon"></iconify-icon>
                            <span>Slide / Banner</span>
                        </a>
                    </li>
                @endif
            @endauth

            <li class="sidebar-menu-group-title">Keuangan</li>

            <li>
                <a href="javascript:void(0)" class="opacity-50 pointer-events-none">
                    <iconify-icon icon="solar:wallet-bold" class="menu-icon"></iconify-icon>
                    <span>Transaksi</span>
                    <span class="bg-neutral-200 dark:bg-neutral-600 text-neutral-500 dark:text-neutral-400 text-[10px] font-semibold px-1.5 py-0.5 rounded-full ms-auto">Soon</span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0)" class="opacity-50 pointer-events-none">
                    <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
                    <span>Laporan</span>
                    <span class="bg-neutral-200 dark:bg-neutral-600 text-neutral-500 dark:text-neutral-400 text-[10px] font-semibold px-1.5 py-0.5 rounded-full ms-auto">Soon</span>
                </a>
            </li>

            <li class="sidebar-menu-group-title">Pengaturan</li>

            @auth('admin')
                @if (auth('admin')->user()->canViewUsers())
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active-page' : '' }}">
                            <iconify-icon icon="solar:users-group-rounded-outline" class="menu-icon"></iconify-icon>
                            <span>Manajemen User</span>
                        </a>
                    </li>
                @endif
            @endauth

            <li>
                <a href="javascript:void(0)" class="opacity-50 pointer-events-none">
                    <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
                    <span>Pengaturan</span>
                    <span class="bg-neutral-200 dark:bg-neutral-600 text-neutral-500 dark:text-neutral-400 text-[10px] font-semibold px-1.5 py-0.5 rounded-full ms-auto">Soon</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
