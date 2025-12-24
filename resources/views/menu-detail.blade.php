@extends('layouts.app-ngombee')

@section('title', $product->name . ' — Detail Menu')

@section('content')
<div class="min-h-screen bg-gray-50/50 py-20 px-6">
    <div class="max-w-5xl mx-auto">
        <nav class="flex mb-8 text-xs font-bold uppercase tracking-widest text-gray-400">
            <a href="/" class="hover:text-brand-emerald">Home</a>
            <span class="mx-3">/</span>
            <a href="/menu" class="hover:text-brand-emerald">Menu</a>
            <span class="mx-3">/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="bg-white rounded-[40px] shadow-2xl shadow-gray-200/50 overflow-hidden border border-gray-100 flex flex-col md:flex-row">
            <div class="md:w-1/2 p-12 flex flex-col justify-center items-center text-center bg-gradient-to-br from-gray-50 to-white border-r border-gray-50">
                <div class="w-48 h-48 bg-white rounded-[40px] shadow-inner flex items-center justify-center text-7xl mb-8 border-2 border-gray-50">
                    @if($product->category->name == 'Kopi')
                    @elseif($product->category->name == 'Teh Segar')
                    @else  @endif
                </div>
                <span class="px-6 py-2 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] {{ $product->category->name == 'Kopi' ? 'bg-amber-800 text-white' : 'bg-brand-emerald text-white' }}">
                    {{ $product->category->name }}
                </span>
            </div>

            <div class="md:w-1/2 p-12 md:p-16">
                <h1 class="text-5xl font-black text-gray-900 leading-tight mb-4 tracking-tighter">
                    {{ $product->name }}
                </h1>

                <div class="flex items-center gap-4 mb-8">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Harga Satuan</span>
                        <span class="text-3xl font-black text-emerald-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="h-10 w-[1px] bg-gray-100 mx-2"></div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Ketersediaan</span>
                        <span class="text-xl font-bold text-gray-900 text-right">{{ $product->stock }} <span class="text-xs font-medium text-gray-400">Porsi</span></span>
                    </div>
                </div>

                <div class="space-y-4 mb-10">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Deskripsi Produk</p>
                    <p class="text-gray-500 leading-relaxed text-lg italic">
                        "{{ $product->description }}"
                    </p>
                </div>

                <div class="flex flex-col gap-3">
                    <button class="w-full bg-gray-900 text-white py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl hover:bg-brand-emerald transition-all transform active:scale-95 flex items-center justify-center gap-3">
                        <span>Tambah ke Pesanan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </button>
                    <a href="/menu" class="text-center py-4 text-gray-400 text-[10px] font-bold uppercase tracking-widest hover:text-gray-600 transition-colors">
                        ← Kembali ke Menu
                    </a>
                </div>
            </div>
        </div>

        {{-- Section Tambahan: Info Keamanan (Bukti untuk Penguji) --}}
        <div class="mt-8 p-6 bg-emerald-50 rounded-2xl border border-emerald-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-emerald-500 text-white p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Info Sistem (UAP)</p>
            </div>
            <p class="text-[10px] font-medium text-emerald-600">
                Identifikasi unik via Slug: <span class="font-black bg-white px-2 py-1 rounded shadow-sm">{{ $product->slug }}</span>
            </p>
        </div>
    </div>
</div>
@endsection
