<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ngombee — Mood Booster in Every Sip')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-effect { @apply bg-white/70 backdrop-blur-xl border-white/20; }
        [data-aos] { opacity: 1 !important; transform: none !important; }
        .aos-init[data-aos] { opacity: 0; }
        .aos-animate[data-aos] { opacity: 1; }
    </style>

    <script>
        const userFromLaravel = @json(Auth::user());
        const userFromStorage = JSON.parse(localStorage.getItem('ngombee_user') || 'null');
        const currentUser = userFromLaravel || userFromStorage;

        window.Laravel = {
            userLoggedIn: !!currentUser,
            user: currentUser,
            routeLogin: "{{ route('login') }}",
            routeRegister: "{{ route('register') }}",
            routeCheckout: "{{ route('checkout') }}"
        };
    </script>
</head>
<body class="bg-[#FAFAFA] text-gray-900 antialiased overflow-x-hidden" x-data="{ atTop: true }" @scroll.window="atTop = (window.pageYOffset > 50 ? false : true)">

    {{-- Scroll Progress Bar --}}
    <div class="fixed top-0 left-0 z-[110] h-1 bg-gradient-to-r from-[#10B981] to-[#6E3A8C] transition-all duration-300"
         :style="'width: ' + (Math.max(0, Math.min(1, window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight))) * 100) + '%'">
    </div>

    {{-- Floating Cart --}}
    @unless(request()->routeIs('checkout'))
    <div x-data="{
            isVisible: false,
            totalItems: 0,
            totalPrice: 0,
            update() {
                try {
                    const cart = JSON.parse(localStorage.getItem('ngombee_cart') || '[]');
                    this.totalItems = cart.reduce((s, i) => s + Number(i.quantity || 0), 0);
                    this.totalPrice = cart.reduce((s, i) => s + (Number(i.price || 0) * Number(i.quantity || 0)), 0);
                    this.isVisible = this.totalItems > 0;
                } catch (e) { this.isVisible = false; }
            }
        }"
        x-init="update()"
        @cart-updated.window="update()"
        x-show="isVisible"
        x-cloak
        class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[9999] w-[95%] max-w-md">

        <div class="bg-white border-2 border-emerald-500 shadow-2xl p-4 rounded-3xl flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-emerald-500 text-white w-12 h-12 rounded-2xl flex items-center justify-center font-black relative">
                    🛒
                    <span class="absolute -top-2 -right-2 bg-rose-500 text-[10px] w-5 h-5 rounded-full flex items-center justify-center border-2 border-white"
                          x-text="totalItems"></span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase leading-none">Total Bayar</p>
                    <p class="font-black text-lg text-emerald-700">Rp <span x-text="totalPrice.toLocaleString('id-ID')"></span></p>
                </div>
            </div>
            <button onclick="window.location.href='/checkout'" class="bg-emerald-500 text-white px-6 py-3 rounded-xl font-black text-xs uppercase shadow-lg active:scale-95">
                Checkout →
            </button>
        </div>
    </div>
    @endunless

    {{-- Navbar --}}
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-24 flex items-center justify-between">

            {{-- Logo Section --}}
            <a :href="window.Laravel?.user?.role === 'admin' ? '/admin/dashboard' : '/'"
            class="group flex items-center gap-3"
            x-data>
                <div class="w-12 h-12 bg-brand-emerald rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-lg shadow-emerald-200 transition-transform group-hover:scale-110">
                    N
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-2xl font-black tracking-tighter text-gray-900 uppercase">Ngombee.</span>
                    <template x-if="window.Laravel?.user?.role === 'admin'">
                        <span class="text-[10px] font-black text-brand-emerald tracking-[0.2em] uppercase mt-1">Admin Panel</span>
                    </template>
                </div>
            </a>

            {{-- Navigation Menu (Hidden for Admin) --}}
            <div class="hidden md:flex items-center space-x-2" x-data="{ user: window.Laravel?.user }">
                <template x-if="!user || user.role !== 'admin'">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('home') }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-widest {{ request()->routeIs('home') ? 'bg-brand-emerald text-white' : 'text-gray-500' }}">Home</a>
                        <a href="{{ route('menu') }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-widest {{ request()->routeIs('menu') ? 'bg-brand-emerald text-white' : 'text-gray-500' }}">Menu</a>
                        <a href="{{ route('about') }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-widest {{ request()->routeIs('about') ? 'bg-brand-emerald text-white' : 'text-gray-500' }}">Our Story</a>
                        <a href="{{ route('promo') }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-widest {{ request()->routeIs('promo') ? 'bg-brand-emerald text-white' : 'text-gray-500' }}">Promo</a>
                        <a href="{{ route('store') }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-widest {{ request()->routeIs('store') ? 'bg-brand-emerald text-white' : 'text-gray-500' }}">Outlet</a>
                    </div>
                </template>
            </div>

            {{-- Profile & Auth Section --}}
            <div class="flex items-center gap-4">
                <div x-data="{ user: window.Laravel?.user }">
                    {{-- User Is Logged In --}}
                    <template x-if="user">
                        <div class="flex items-center gap-3 bg-white p-1.5 pr-4 rounded-2xl border-2 border-gray-100 shadow-sm">
                            <a :href="user.role === 'admin' ? '/admin/dashboard' : '/dashboard'"
                               class="w-12 h-12 bg-gray-900 rounded-[18px] flex items-center justify-center text-white font-black hover:bg-brand-emerald transition-colors">
                                <span x-text="user.name ? user.name.substring(0, 1).toUpperCase() : 'U'"></span>
                            </a>

                            <button onclick="logout()" class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4-4H7m6 4v1h-3.33" />
                                </svg>
                            </button>
                        </div>
                    </template>

                    {{-- User Is Guest (Register & Login Buttons) --}}
                    <template x-if="!user">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-gray-700 font-black text-xs uppercase tracking-widest hover:text-brand-emerald transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-brand-emerald text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-emerald-100 hover:scale-[1.05] transition-all">
                                Register
                            </a>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </nav>

    <main class="relative z-10 pt-24">
        @yield('content')
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            disable: 'mobile'
        });

        window.refreshCartUI = function() {
            window.dispatchEvent(new CustomEvent('cart-updated'));
        };

        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                localStorage.clear();
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('logout') }}";
                form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}">`;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
