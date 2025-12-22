@extends('layouts.app-ngombee')

@section('content')
<div class="pt-32 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase">Member <span class="text-brand-emerald italic">Area</span></h1>
                <p class="text-gray-500 font-bold">Selamat datang kembali, {{ Auth::user()->name }}! 👋</p>
            </div>
            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase">Status Member</p>
                    <p class="text-brand-emerald font-black uppercase">Gold Member</p>
                </div>
                <span class="text-4xl">🏆</span>
            </div>
        </div>

        <div class="bg-brand-emerald rounded-[40px] p-10 text-white flex flex-col md:flex-row justify-between items-center shadow-2xl shadow-emerald-200 mb-10 relative overflow-hidden">
            <div class="relative z-10 text-center md:text-left">
                <h2 class="text-4xl font-black mb-4">Haus? Langsung Ngombe! 🍹</h2>
                <p class="text-emerald-100 font-bold mb-8 max-w-md">Nikmati kemudahan pesan langsung dari dashboard dan kumpulkan poin setiap pembelian.</p>
                <a href="{{ route('menu') }}#menu-pilihan" class="bg-white text-brand-emerald px-10 py-5 rounded-2xl font-black shadow-xl hover:scale-105 transition inline-block">
                    MULAI PESAN SEKARANG
                </a>
            </div>
            <span class="text-[180px] opacity-20 absolute -right-10 -bottom-10 rotate-12">🧋</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#702D8E] p-8 rounded-[40px] text-white">
                <p class="uppercase text-xs font-black opacity-60 mb-2">Total Ngombee Points</p>
                <h3 class="text-5xl font-black mb-6">2.450 <span class="text-lg opacity-60 italic">pts</span></h3>
                <button class="w-full bg-white/20 hover:bg-white/30 py-4 rounded-2xl font-black transition">TUKAR POIN</button>
            </div>

            <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100">
                <span class="text-4xl mb-4 block">🎫</span>
                <h3 class="font-black text-2xl mb-2">Voucher Saya</h3>
                <p class="text-gray-400 mb-6">Ada 3 voucher diskon tersedia.</p>
                <a href="#" class="text-brand-emerald font-black uppercase text-sm tracking-widest hover:underline">Lihat Semua →</a>
            </div>

            <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100">
                <span class="text-4xl mb-4 block">🕒</span>
                <h3 class="font-black text-2xl mb-2">Terakhir Dibeli</h3>
                <div class="bg-gray-50 p-4 rounded-2xl flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-xl">🧋</div>
                    <div>
                        <p class="font-black text-sm">Brown Sugar Milk Tea</p>
                        <p class="text-[10px] text-gray-400">12 Des 2025 • Outlet Jakarta</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
