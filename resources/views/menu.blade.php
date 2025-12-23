@extends('layouts.app-ngombee')

@section('title', 'Menu Catalog - Ngombee')

@section('content')
<section class="py-20 md:py-32 bg-gray-50/50" x-data="menuHandler()">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl md:text-7xl font-black mb-4 uppercase tracking-tighter text-gray-900">
                Drink <span class="text-brand-emerald italic">Catalog</span>
            </h2>
            <p class="text-gray-500 font-bold uppercase tracking-[0.3em] text-xs">Pilih Minuman Segar Favoritmu</p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-20">
            <button @click="activeCategory = 'all'"
                :class="activeCategory === 'all' ? 'bg-gray-900 text-white shadow-xl scale-105' : 'bg-white text-gray-500 hover:bg-gray-100 border border-gray-200'"
                class="px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all duration-300">
                SEMUA MENU
            </button>

            <template x-for="cat in categories" :key="cat.id">
                <button @click="activeCategory = String(cat.id)"
                    :class="activeCategory === String(cat.id) ? 'bg-brand-emerald text-white shadow-lg scale-105' : 'bg-white text-gray-500 hover:bg-gray-100 border border-gray-200'"
                    class="px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all duration-300">
                    <span x-text="cat.name"></span>
                </button>
            </template>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <template x-for="item in filteredItems" :key="item.id">
                <div class="group relative bg-white rounded-[2.5rem] p-6 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col h-full">
                    <div class="absolute top-6 left-6 z-10">
                        <span class="bg-gray-900/5 backdrop-blur-md text-gray-900 text-[9px] font-black px-3 py-1.5 rounded-full uppercase tracking-tighter" x-text="item.category?.name || 'Drink'"></span>
                    </div>

                    <div class="relative h-56 mb-6 rounded-[2rem] bg-gray-50 overflow-hidden flex items-center justify-center transition-colors group-hover:bg-brand-emerald/5">
                        <div class="text-7xl transform group-hover:scale-125 group-hover:rotate-12 transition-all duration-500 drop-shadow-2xl">🥤</div>
                    </div>

                    <div class="text-left flex-grow">
                        <h3 class="font-black text-xl text-gray-900 mb-1 leading-tight group-hover:text-brand-emerald transition-colors" x-text="item.name"></h3>
                        <div class="flex justify-between items-center mb-4">
                            <p class="text-brand-emerald font-black text-lg">Rp <span x-text="item.price.toLocaleString('id-ID')"></span></p>
                            <span :class="item.stock > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700'"
                                  class="text-[9px] font-black px-2 py-1 rounded-lg uppercase transition-all">
                                <span x-text="item.stock > 0 ? 'Stok: ' + item.stock : 'Habis'"></span>
                            </span>
                        </div>
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <template x-if="item.stock <= 0">
                            <button disabled class="w-full bg-gray-100 text-gray-400 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest cursor-not-allowed">
                                SOLD OUT
                            </button>
                        </template>

                        <template x-if="item.stock > 0">
                            <div>
                                <!-- Tampilan saat sudah di keranjang -->
                                <div x-show="getCartQty(item.id) > 0"
                                     class="flex items-center justify-between w-full bg-gray-900 rounded-2xl p-1.5 text-white shadow-inner">
                                    <button @click.stop="updateCart('remove', item)" class="w-10 h-10 flex items-center justify-center font-black rounded-xl bg-white/10 hover:bg-white/20 transition-colors">−</button>
                                    <span class="font-black text-sm" x-text="getCartQty(item.id)"></span>
                                    <button @click.stop="updateCart('add', item)"
                                            :disabled="getCartQty(item.id) >= item.stock"
                                            class="w-10 h-10 flex items-center justify-center font-black rounded-xl bg-white/10 hover:bg-white/20 transition-colors"
                                            :class="{'opacity-20 cursor-not-allowed': getCartQty(item.id) >= item.stock}">+</button>
                                </div>

                                <!-- Tampilan saat belum di keranjang -->
                                <button x-show="getCartQty(item.id) === 0"
                                    @click.stop="updateCart('add', item)"
                                    class="w-full bg-brand-emerald hover:bg-gray-900 text-white py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all duration-300 shadow-md">
                                    ADD TO CART +
                                </button>
                            </div>
                        </template>
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
            // State internal untuk memicu re-render Alpine
            cartVersion: 0,

            get filteredItems() {
                if (this.activeCategory === 'all') return this.items;
                return this.items.filter(i => String(i.category_id) === String(this.activeCategory));
            },

            // Listener untuk update versi keranjang
            init() {
                window.addEventListener('cart-updated', () => {
                    this.cartVersion++;
                });
            },

            getCartQty(id) {
                // cartVersion digunakan di sini agar Alpine tahu fungsi ini harus dihitung ulang
                this.cartVersion;
                const cart = JSON.parse(localStorage.getItem('ngombee_cart') || '[]');
                const item = cart.find(i => i.id === id);
                return item ? item.quantity : 0;
            },

            updateCart(action, item) {
                if (!localStorage.getItem('ngombee_token')) {
                    window.location.href = window.Laravel.routeLogin;
                    return;
                }

                let cart = JSON.parse(localStorage.getItem('ngombee_cart') || '[]');

                // Pastikan item.id adalah angka agar pencarian akurat
                let found = cart.find(i => i.id === item.id);

                if (action === 'add') {
                    if (found) {
                        if (found.quantity < item.stock) {
                            found.quantity = parseInt(found.quantity) + 1;
                        } else {
                            alert('Stok tidak mencukupi!');
                            return;
                        }
                    } else {
                        // BERSIHKAN DATA: Pastikan price dan stock hanya angka
                        cart.push({
                            id: item.id,
                            name: item.name,
                            price: Number(item.price),
                            quantity: 1,
                            stock: Number(item.stock)
                        });
                    }
                } else {
                    if (found) {
                        found.quantity = parseInt(found.quantity) - 1;
                        if (found.quantity <= 0) {
                            cart = cart.filter(i => i.id !== item.id);
                        }
                    }
                }

                localStorage.setItem('ngombee_cart', JSON.stringify(cart));
                window.refreshCartUI();
            }
        }
    }
</script>
@endsection
