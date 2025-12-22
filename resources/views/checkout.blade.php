@extends('layouts.app-ngombee')

@section('content')
<div class="pt-32 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black text-gray-900">Checkout</h1>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md mb-8">
            <h2 class="text-xl font-bold mb-4">Detail Pesanan</h2>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="space-y-4">
                    @foreach(session('cart') as $item)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-bold">{{ $item['name'] }}</p>
                                <p class="text-gray-500">Rp {{ number_format($item['price'], 0, ',', '.') }} x {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-bold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="border-t pt-4 mt-4">
                    <div class="flex justify-between items-center">
                        <p class="font-bold">Total Pembayaran</p>
                        <p class="text-3xl font-black text-brand-emerald">
                            Rp {{ number_format(collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']), 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    Keranjang Anda kosong.
                    <br>
                    <a href="{{ route('menu') }}" class="text-brand-emerald hover:underline">Kembali ke Menu</a>
                </div>
            @endif
        </div>

        @if(session('cart') && count(session('cart')) > 0)
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <button type="submit" class="w-full bg-brand-emerald text-white py-3 rounded-xl font-black">
                    Konfirmasi Pembelian
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
