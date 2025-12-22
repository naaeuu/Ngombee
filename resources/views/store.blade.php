@extends('layouts.app-ngombee')

@section('content')
<div class="pt-32 pb-20 bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-12 mb-20">
            <div class="md:w-1/2" data-aos="fade-right">
                <span class="text-brand-emerald font-black tracking-[0.2em] uppercase text-sm">Find Us</span>
                <h2 class="text-6xl font-black text-gray-900 mt-4 mb-6 leading-tight">Cari Outlet <br><span class="text-[#702D8E]">Ngombee</span> Terdekat</h2>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">Nikmati kesegaran minuman favoritmu langsung dari outlet kami yang tersebar di seluruh Indonesia.</p>
                <div class="relative">
                    <input type="text" placeholder="Masukkan nama kota kamu..." class="w-full py-5 px-8 rounded-2xl border-2 border-gray-200 focus:border-brand-emerald focus:ring-0 transition text-lg shadow-sm">
                    <button class="absolute right-3 top-3 bg-[#702D8E] text-white px-8 py-3 rounded-xl font-bold">CARI</button>
                </div>
            </div>

            <div class="md:w-1/2 relative" data-aos="zoom-in-left">
                <div class="w-full h-[500px] bg-gray-200 rounded-[50px] overflow-hidden shadow-2xl border-8 border-white">
                    <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?auto=format&fit=crop&q=80&w=800" alt="Store" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                </div>
                <div class="absolute -bottom-10 -left-10 bg-white p-8 rounded-3xl shadow-2xl" data-aos="fade-up" data-aos-delay="400">
                    <h4 class="font-black text-2xl text-gray-800">50+ Outlets</h4>
                    <p class="text-gray-500">Across Indonesia</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach(['Jakarta', 'Bandung', 'Surabaya', 'Malang'] as $city)
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="w-12 h-12 bg-emerald-100 text-brand-emerald rounded-2xl flex items-center justify-center text-2xl mb-4">📍</div>
                <h5 class="font-black text-xl mb-2">Ngombee {{ $city }}</h5>
                <p class="text-gray-500 text-sm mb-4">Jl. Kesegaran No. {{ $loop->index + 1 }}, Area Mall Center.</p>
                <a href="#" class="text-[#702D8E] font-bold text-sm hover:underline italic">Lihat Map →</a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
