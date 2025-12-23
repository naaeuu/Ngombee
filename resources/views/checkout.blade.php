@extends('layouts.app-ngombee')

@section('content')
<div class="pt-32 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black text-gray-900">Checkout</h1>
        </div>

        {{-- ✅ Detail Pesanan dari localStorage + Validasi Data --}}
        <div x-data="{
            cart: [],
            init() {
                // Ambil data mentah dari localStorage
                let rawCart = JSON.parse(localStorage.getItem('ngombee_cart') || '[]');

                // ✅ FILTER: Hanya ambil item yang valid
                this.cart = rawCart.filter(item => {
                    // Pastikan item memiliki ID, nama, harga valid, dan kuantitas > 0
                    return item.id &&
                           item.name &&
                           item.name.trim() !== '' &&
                           !isNaN(item.price) &&
                           Number(item.price) > 0 &&
                           !isNaN(item.quantity) &&
                           Number(item.quantity) > 0;
                });

                // ✅ Simpan kembali data yang sudah dibersihkan
                localStorage.setItem('ngombee_cart', JSON.stringify(this.cart));
            },
            get totalPrice() {
                return this.cart.reduce((s, i) => s + (Number(i.price) * Number(i.quantity)), 0);
            }
        }" class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">

            <h2 class="text-xl font-black mb-6">Detail Pesanan</h2>

            <template x-if="cart.length === 0">
                <div class="text-center py-10">
                    <p class="text-gray-400 mb-4">Keranjang Anda kosong.</p>
                    <a href="/menu" class="text-emerald-500 font-bold underline">Kembali ke Menu</a>
                </div>
            </template>

            <template x-if="cart.length > 0">
                <div class="space-y-4">
                    <template x-for="item in cart" :key="item.id">
                        <div class="flex justify-between items-center border-b pb-4">
                            <div>
                                <p class="font-bold text-gray-800" x-text="item.name"></p>
                                <p class="text-xs text-gray-500">
                                    <span x-text="Number(item.quantity)"></span> x Rp <span x-text="Number(item.price).toLocaleString('id-ID')"></span>
                                </p>
                            </div>
                            <p class="font-black text-emerald-600">
                                Rp <span x-text="(Number(item.price) * Number(item.quantity)).toLocaleString('id-ID')"></span>
                            </p>
                        </div>
                    </template>

                    <div class="pt-4 flex justify-between items-center">
                        <p class="text-lg font-bold">Total Pembayaran</p>
                        <p class="text-2xl font-black text-emerald-500">
                            Rp <span x-text="totalPrice.toLocaleString('id-ID')"></span>
                        </p>
                    </div>

                    <button @click="prosesBayar()" class="w-full bg-emerald-500 text-white py-4 rounded-2xl font-black mt-6 shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition-all">
                        KONFIRMASI PEMBAYARAN
                    </button>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
async function prosesBayar() {
    const cart = JSON.parse(localStorage.getItem('ngombee_cart') || '[]');
    const token = localStorage.getItem('ngombee_token');

    if (cart.length === 0) {
        alert('Keranjang kosong!');
        return;
    }

    if (!token) {
        alert('Silakan login terlebih dahulu.');
        window.location.href = '/login';
        return;
    }

    try {
        const response = await fetch('/api/user/direct-checkout', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                items: cart.map(item => ({
                    id: Number(item.id),
                    quantity: Number(item.quantity),
                    price: Number(item.price)
                }))
            })
        });

        const res = await response.json();
        if (res.success) {
            alert('Pembayaran Berhasil!');
            localStorage.removeItem('ngombee_cart');
            window.location.href = "/dashboard";
        } else {
            alert('Gagal: ' + (res.message || 'Cek stok tersedia'));
        }
    } catch (e) {
        console.error('Error:', e);
        alert('Terjadi kesalahan jaringan.');
    }
}
</script>
@endsection
