<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ngombee — Mood Booster in Every Sip')</title>

    {{-- SEO & Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">

    <script>
        window.Laravel = {
            userLoggedIn: {{ Auth::check() ? 'true' : 'false' }},
            routeLogin: "{{ route('login') }}",
            routeCheckout: "{{ route('checkout') }}"
        };
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-effect { @apply bg-white/70 backdrop-blur-xl border-white/20; }
        .text-gradient { @apply bg-clip-text text-transparent bg-gradient-to-r from-[#10B981] to-[#6E3A8C]; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-gray-900 antialiased overflow-x-hidden" x-data="{ atTop: true }" @scroll.window="atTop = (window.pageYOffset > 50 ? false : true)">

    {{-- Scroll Progress Bar --}}
    <div class="fixed top-0 left-0 z-[110] h-1 bg-gradient-to-r from-[#10B981] to-[#6E3A8C] transition-all duration-300"
         :style="'width: ' + (Math.max(0, Math.min(1, window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight))) * 100) + '%'">
    </div>

    {{-- ✅ Floating Cart: Hanya muncul di halaman selain checkout --}}
    @unless(request()->routeIs('checkout'))
    <div x-data="{ isVisible: false }"
        x-init="
            $watch('$store.cart.items', () => {
                isVisible = $store.cart.getTotalItems() > 0;
            });
            isVisible = $store.cart.getTotalItems() > 0;
        "
        x-show="isVisible"
        x-cloak
        x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-500"
        x-transition:enter-start="opacity-0 translate-y-20 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[90] w-[95%] max-w-2xl">

        <div class="bg-white border border-brand-emerald shadow-[0_20px_50px_rgba(16,185,129,0.2)] p-4 rounded-[32px] flex items-center justify-between group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="w-14 h-14 bg-gradient-to-tr from-brand-emerald to-emerald-400 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-rose-500 text-white text-[10px] font-black w-6 h-6 rounded-full flex items-center justify-center border-2 border-white" x-text="$store.cart.getTotalItems()"></span>
                    </div>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 leading-none mb-1">Total Checkout</p>
                    <p class="text-2xl font-black text-gray-800 tracking-tight">Rp <span x-text="$store.cart.getTotalPrice().toLocaleString('id-ID')"></span></p>
                </div>
            </div>

            {{-- ✅ Tombol Checkout Langsung --}}
            <button
                onclick="bayarSekarang()"
                class="bg-brand-emerald text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all hover:bg-emerald-600 hover:scale-105 active:scale-95 shadow-xl">
                Bayar Sekarang →
            </button>
        </div>
    </div>
    @endunless

    {{-- Solid & Premium Navbar --}}
    <nav class="fixed w-full z-[100] transition-all duration-300"
        x-data="{ atTop: true }"
        @scroll.window="atTop = (window.pageYOffset > 20 ? false : true)"
        :class="atTop ? 'py-6 bg-white shadow-md' : 'py-4 bg-white border-b-4 border-brand-emerald shadow-xl'">

        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            {{-- Logo Section --}}
            <a href="{{ route('home') }}" class="group flex items-center gap-3">
                <div class="w-10 h-10 bg-brand-emerald rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg group-hover:rotate-6 transition-transform">
                    N
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-2xl font-black tracking-tighter text-gray-900 uppercase">Ngombee.</span>
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <span class="text-[9px] font-black text-brand-emerald tracking-[0.3em] uppercase">Admin Panel</span>
                    @endif
                </div>
            </a>

            {{-- Menu Links: HANYA MUNCUL JIKA BUKAN ADMIN --}}
            @if(!(Auth::check() && Auth::user()->role === 'admin'))
            <div class="hidden md:flex items-center space-x-2">
                @foreach(['home' => 'Home', 'menu' => 'Menu', 'about' => 'Our Story', 'promo' => 'Promo', 'store' => 'Outlet'] as $route => $label)
                <a href="{{ route($route) }}"
                    class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all
                        {{ request()->routeIs($route) ? 'bg-brand-emerald text-white shadow-md' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
            @endif

            {{-- Auth Section --}}
            <div class="flex items-center gap-4">
                @auth
                    <div class="flex items-center gap-3 bg-white p-1.5 pr-4 rounded-2xl border-2 border-gray-100 shadow-sm hover:border-brand-emerald/30 transition-all duration-300">
                        <a href="{{ route('dashboard') }}"
                        class="group relative w-12 h-12 flex items-center justify-center bg-gray-900 rounded-[18px] overflow-hidden transition-all duration-300 active:scale-90 shadow-lg">
                            <div class="absolute inset-0 bg-gradient-to-tr from-brand-emerald to-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <span class="relative z-10 text-white font-[1000] text-lg tracking-tighter">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </a>

                        <div class="hidden lg:flex flex-col leading-tight">
                            <span class="text-[12px] font-[1000] text-gray-900 tracking-tight">
                                {{ strtoupper(explode(' ', Auth::user()->name)[0]) }}
                            </span>
                            <div class="flex items-center gap-1.5">
                                @if(Auth::user()->role === 'admin')
                                    <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                                    <span class="text-[9px] font-extrabold text-rose-500 uppercase tracking-[0.15em]">Admin</span>
                                @else
                                    <span class="w-1.5 h-1.5 bg-brand-emerald rounded-full animate-pulse"></span>
                                    <span class="text-[9px] font-extrabold text-gray-400 uppercase tracking-[0.15em]">Member</span>
                                @endif
                            </div>
                        </div>

                        <div class="h-10 w-[2px] bg-gray-50 mx-1"></div>

                        <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                            @csrf
                            <button type="submit"
                                    class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition-all duration-200 hover:rotate-12"
                                    title="Keluar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4-4H7m6 4v1h-3.33" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-5">
                        <a href="{{ route('login') }}" class="text-[11px] font-black text-gray-400 hover:text-gray-900 uppercase tracking-[0.2em] transition">Login</a>
                        <a href="{{ route('register') }}"
                        class="bg-brand-emerald text-white px-8 py-4 rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg shadow-emerald-100 hover:-translate-y-1 active:scale-95 transition-all">
                            Join Member
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="relative z-10 pt-24">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-100 py-20 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-1 bg-gradient-to-r from-transparent via-gray-100 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="mb-8">
                <span class="text-4xl font-black text-[#10B981] tracking-tighter">NGOMBEE.</span>
                <p class="text-gray-400 font-medium mt-4 max-w-sm mx-auto">Menghadirkan kesegaran teh dan kopi kualitas premium langsung ke genggamanmu.</p>
            </div>
            <div class="flex justify-center gap-8 mb-12">
                @foreach(['Instagram', 'Tiktok', 'WhatsApp'] as $socmed)
                    <a href="#" class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 hover:text-[#10B981] transition">{{ $socmed }}</a>
                @endforeach
            </div>
            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic">&copy; 2025 Ngombee Indonesia — Crafted for Freshness</p>
        </div>
    </footer>

    {{-- ✅ Script: Checkout Langsung dari Floating Cart --}}
    @push('scripts')
    <script>
        async function bayarSekarang() {
            // Ambil data terbaru dari Alpine Store
            const cartData = window.Alpine.store('cart').items;

            if (!cartData || cartData.length === 0) {
                alert('Gagal: Keranjang kosong di browser.');
                return;
            }

            if (!confirm('Konfirmasi Pembelian?')) return;

            try {
                const response = await fetch('{{ route("direct.checkout") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    // Pastikan kita mengirimkan array items
                    body: JSON.stringify({ items: cartData })
                });

                const result = await response.json();

                if (result.success) {
                    alert('Mantap! Pembelian Berhasil & Stok Berkurang.');

                    // Bersihkan Alpine Store
                    window.Alpine.store('cart').items = [];
                    localStorage.removeItem('cart');

                    // Refresh untuk update tampilan stok "Tersedia: X"
                    window.location.reload();
                } else {
                    alert('Gagal: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan sistem.');
            }
        }
    </script>
    @endpush

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                duration: 1000,
                once: true,
                offset: 50,
                easing: 'ease-out-expo'
            });

            // ✅ Pastikan Alpine store cart diinisialisasi
            if (window.Alpine) {
                document.addEventListener('alpine:init', () => {
                    if (!Alpine.store('cart')) {
                        Alpine.store('cart', {
                            userLoggedIn: window.Laravel.userLoggedIn,
                            items: [],
                            getTotalItems() {
                                return this.items.reduce((total, item) => total + item.quantity, 0);
                            },
                            getTotalPrice() {
                                return this.items.reduce((total, item) => total + (item.price * item.quantity), 0);
                            },
                            getItemQty(productId) {
                                const item = this.items.find(i => i.id === productId);
                                return item ? item.quantity : 0;
                            },
                            addToCart(id, name, price) {
                                const existing = this.items.find(item => item.id === id);
                                if (existing) {
                                    existing.quantity++;
                                } else {
                                    this.items.push({ id, name, price, quantity: 1 });
                                }
                            },
                            removeFromCart(id) {
                                const index = this.items.findIndex(item => item.id === id);
                                if (index !== -1) {
                                    if (this.items[index].quantity > 1) {
                                        this.items[index].quantity--;
                                    } else {
                                        this.items.splice(index, 1);
                                    }
                                }
                            }
                        });
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
