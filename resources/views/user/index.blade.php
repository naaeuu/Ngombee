@extends('layouts.app-ngombee')

@section('content')
<div x-data="{
    cart: [],
    @auth isLoggedIn: true @else isLoggedIn: false @endauth,
    addToCart(id, name, price) {
        if (!this.isLoggedIn) {
            window.location.href = '{{ route('login') }}';
            return;
        }
        let item = this.cart.find(i => i.id === id);
        if (item) { item.qty++; }
        else { this.cart.push({ id: id, name: name, price: price, qty: 1 }); }
    },
    totalItems() { return this.cart.reduce((sum, i) => sum + i.qty, 0) },
    totalPrice() { return this.cart.reduce((sum, i) => sum + (i.price * i.qty), 0) }
}">

    <section class="pt-32 pb-20 bg-brand-light relative overflow-hidden min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2" data-aos="fade-right">
                <h1 class="text-6xl md:text-8xl font-black leading-tight mb-6 text-gray-900">
                    Segarkan Harimu <br><span class="text-brand-emerald">Setiap Saat.</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10 max-w-lg leading-relaxed">
                    Ngombe hadir dengan bahan premium terbaik untuk menciptakan momen spesial di setiap tegukan Anda. Kami percaya kebahagiaan dimulai dari gelas yang tepat.
                </p>
                <div class="flex space-x-4">
                    <a href="#menu-pilihan" class="bg-brand-emerald text-white px-10 py-5 rounded-2xl font-black text-lg shadow-xl shadow-emerald-200 hover:scale-105 transition transform inline-block">PESAN SEKARANG</a>
                    <a href="{{ route('about') }}" class="border-2 border-brand-emerald text-brand-emerald px-10 py-5 rounded-2xl font-black text-lg hover:bg-brand-emerald hover:text-white transition">OUR STORY</a>
                </div>
            </div>
            <div class="md:w-1/2 mt-12 md:mt-0 relative" data-aos="zoom-in">
                <div class="w-full h-[600px] bg-emerald-200 rounded-[60px] flex items-center justify-center border-4 border-dashed border-emerald-400 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/20 to-transparent"></div>
                    <span class="text-emerald-700 font-black text-2xl uppercase text-center p-10">[FOTO HERO PRODUK PNG - UKURAN BESAR]</span>
                </div>
                <div class="absolute -top-10 -right-10 text-6xl animate-bounce">🍃</div>
                <div class="absolute -bottom-10 -left-10 text-6xl animate-bounce delay-700">🌿</div>
            </div>
        </div>
    </section>

    <section id="menu-pilihan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-black mb-10 italic">MENU UNGGULAN</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

                <div class="relative group">
                    <div class="bg-brand-light rounded-[40px] h-64 relative overflow-hidden">
                        <button @click="addToCart(1, 'Earl Grey Cream', 28000)"
                                class="absolute bottom-4 right-4 bg-brand-emerald text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition active:scale-95">
                            <span class="text-2xl font-bold" x-text="cart.find(i => i.id === 1) ? cart.find(i => i.id === 1).qty : '+'"></span>
                        </button>
                    </div>
                    <h3 class="font-black mt-4 text-xl">Earl Grey Cream</h3>
                    <p class="text-brand-emerald font-bold">Rp 28.000</p>
                </div>

                </div>
        </div>
    </section>

    @auth
    <div x-show="totalItems() > 0"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-24"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="fixed bottom-8 left-1/2 -translate-x-1/2 w-[90%] md:w-[600px] z-[100]">

        <div class="bg-brand-emerald rounded-[35px] shadow-2xl p-4 flex items-center justify-between text-white border-4 border-white">
            <div class="flex items-center gap-4">
                <div class="bg-white text-brand-emerald w-10 h-10 rounded-xl flex items-center justify-center font-black" x-text="totalItems()"></div>
                <div>
                    <p class="text-[10px] font-black opacity-80 uppercase leading-none mb-1">Total</p>
                    <p class="text-xl font-black" x-text="'Rp ' + totalPrice().toLocaleString('id-ID')"></p>
                </div>
            </div>
            <button class="bg-[#702D8E] text-white px-10 py-3 rounded-2xl font-black shadow-lg flex items-center gap-2">
                PESAN <span class="text-xl">→</span>
            </button>
        </div>
    </div>
    @endauth

</div> @endsection
