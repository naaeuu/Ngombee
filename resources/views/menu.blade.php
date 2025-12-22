@extends('layouts.app-ngombee')

@section('title', 'Menu Catalog - Ngombee')

@section('content')
<section class="py-20 md:py-32 bg-white" x-data="menuHandler()">
    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-5xl font-black mb-4 uppercase tracking-tighter text-gray-900">
                Drink <span class="text-brand-emerald italic text-6xl">Catalog</span>
            </h2>
            <p class="text-gray-500 font-medium">Pilih minuman favoritmu dan nikmati kesegarannya.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mb-20">
            <button @click="activeCategory = 'all'"
                :class="activeCategory === 'all' ? 'bg-black text-white scale-110 shadow-xl' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'"
                class="px-8 py-4 rounded-[25px] font-black uppercase text-xs tracking-[0.2em] transition-all duration-300 transform"
                data-aos="zoom-in">
                SEMUA
            </button>

            <template x-for="cat in categories" :key="cat.id">
                <button @click="activeCategory = String(cat.id)"
                    :class="activeCategory === String(cat.id) ? cat.color + ' text-white scale-110 shadow-xl' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'"
                    class="px-8 py-4 rounded-[25px] font-black uppercase text-xs tracking-[0.2em] transition-all duration-300 transform"
                    data-aos="zoom-in" data-aos-delay="100">
                    <span x-text="cat.name"></span>
                </button>
            </template>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
            <template x-for="item in filteredItems" :key="item.id">
                <div
                    :class="item.bgColor"
                    class="group rounded-[40px] p-8 shadow-lg hover:shadow-2xl transition duration-500 relative overflow-hidden"
                    data-aos="fade-up" data-aos-once="true">

                    <div class="h-64 mb-6 flex items-center justify-center">
                        <div class="text-7xl group-hover:scale-110 transition duration-500">🥤</div>
                    </div>

                    <div class="text-center">
                        <h3 class="font-black text-2xl text-white mb-1 drop-shadow-md" x-text="item.name"></h3>
                        <p class="text-white/90 font-bold mb-1" x-text="'Rp ' + item.price.toLocaleString('id-ID')"></p>

                        <!-- Status Stok -->
                        <div class="inline-block px-3 py-1 rounded-full bg-black/20 backdrop-blur-sm mb-4">
                            <p class="text-[10px] font-black uppercase tracking-widest"
                               :class="item.stock > 0 ? 'text-white' : 'text-rose-300'"
                               x-text="item.stock > 0 ? 'Tersedia: ' + item.stock : 'Stok Habis'">
                            </p>
                        </div>

                        <div class="mt-4 h-12">
                            <!-- Jika Stok Habis -->
                            <template x-if="item.stock <= 0">
                                <button disabled class="w-full bg-gray-400 text-white py-3 rounded-2xl font-black uppercase text-xs cursor-not-allowed">
                                    SOLD OUT
                                </button>
                            </template>

                            <!-- Jika Masih Ada Stok -->
                            <template x-if="item.stock > 0">
                                <div>
                                    <!-- Sudah Ada di Keranjang -->
                                    <div x-show="$store.cart.userLoggedIn && $store.cart.getItemQty(item.id) > 0"
                                         class="flex items-center justify-between w-full bg-brand-emerald rounded-2xl p-1 text-white">
                                        <button @click.stop="updateCart('remove', item)"
                                                class="w-8 h-8 flex items-center justify-center font-black rounded-full bg-white/20 hover:bg-white/40">−</button>
                                        <span class="font-black" x-text="$store.cart.getItemQty(item.id)"></span>
                                        <button @click.stop="updateCart('add', item)"
                                                :disabled="$store.cart.getItemQty(item.id) >= item.stock"
                                                class="w-8 h-8 flex items-center justify-center font-black rounded-full bg-white/20 hover:bg-white/40"
                                                :class="{'opacity-20 cursor-not-allowed': $store.cart.getItemQty(item.id) >= item.stock}">+</button>
                                    </div>

                                    <!-- Belum Ada di Keranjang -->
                                    <button x-show="$store.cart.userLoggedIn && $store.cart.getItemQty(item.id) === 0"
                                        @click.stop="updateCart('add', item)"
                                        class="w-full bg-white text-gray-900 py-3 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-gray-100 transition">
                                        TAMBAH +
                                    </button>

                                    <!-- Belum Login -->
                                    <button x-show="!$store.cart.userLoggedIn"
                                        @click.stop="window.location.href = '{{ route('login') }}'"
                                        class="w-full bg-gray-900 text-white py-3 rounded-2xl font-black uppercase text-xs tracking-widest">
                                        TAMBAH +
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

<script>
    function menuHandler() {
        return {
            activeCategory: 'all',
            categories: @json($categories),
            items: @json($products),

            get filteredItems() {
                if (this.activeCategory === 'all') return this.items;
                return this.items.filter(i => String(i.category_id) === String(this.activeCategory));
            },

            updateCart(action, item) {
                if (!this.$store.cart.userLoggedIn) {
                    window.location.href = "{{ route('login') }}";
                    return;
                }

                if (action === 'add') {
                    if (this.$store.cart.getItemQty(item.id) < item.stock) {
                        this.$store.cart.addToCart(item.id, item.name, item.price);
                    } else {
                        alert('Stok tidak mencukupi!');
                    }
                } else {
                    this.$store.cart.removeFromCart(item.id);
                }

                document.dispatchEvent(new CustomEvent('cart-updated'));
            }
        }
    }
</script>
@endsection
