@extends('layouts.app-ngombee')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 pt-24 pb-12 px-4 overflow-hidden">
    <div class="max-w-5xl w-full bg-white rounded-[50px] shadow-2xl overflow-hidden flex flex-col md:flex-row-reverse border-4 border-white" data-aos="flip-left" data-aos-duration="1000">

        <div class="md:w-1/2 bg-[#702D8E] p-12 text-white flex flex-col justify-center relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-4xl font-black mb-8 italic leading-tight" data-aos="fade-left" data-aos-delay="300">GABUNG GENG <br>NGOMBEE SEKARANG!</h2>
                <ul class="space-y-6">
                    <li class="flex items-center gap-4 font-bold text-lg" data-aos="fade-left" data-aos-delay="400">
                        <span class="w-10 h-10 bg-emerald-400 rounded-full flex items-center justify-center text-white shadow-lg animate-pulse">✓</span>
                        Gratis 1 Welcome Drink
                    </li>
                    <li class="flex items-center gap-4 font-bold text-lg" data-aos="fade-left" data-aos-delay="500">
                        <span class="w-10 h-10 bg-emerald-400 rounded-full flex items-center justify-center text-white shadow-lg animate-pulse">✓</span>
                        Poin Tiap Transaksi
                    </li>
                    <li class="flex items-center gap-4 font-bold text-lg" data-aos="fade-left" data-aos-delay="600">
                        <span class="w-10 h-10 bg-emerald-400 rounded-full flex items-center justify-center text-white shadow-lg animate-pulse">✓</span>
                        Promo Ulang Tahun
                    </li>
                </ul>
            </div>
            <div class="absolute -top-10 -right-10 text-[150px] opacity-10 rotate-12 animate-float">🍃</div>
        </div>

        <div class="md:w-1/2 p-12 bg-white" data-aos="fade-right" data-aos-delay="200">
            <div class="mb-8">
                <h3 class="text-3xl font-black text-gray-800">Daftar Akun</h3>
                <p class="text-gray-400 mt-2 font-medium">Hanya butuh 1 menit!</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div data-aos="fade-up" data-aos-delay="300">
                    <input type="text" name="name" placeholder="Nama Lengkap" class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-2 border-transparent focus:border-[#702D8E] focus:bg-white focus:ring-0 transition duration-300" required>
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <input type="email" name="email" placeholder="Email Aktif" class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-2 border-transparent focus:border-[#702D8E] focus:bg-white focus:ring-0 transition duration-300" required>
                </div>
                <div data-aos="fade-up" data-aos-delay="500">
                    <input type="password" name="password" placeholder="Password" class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-2 border-transparent focus:border-[#702D8E] focus:bg-white focus:ring-0 transition duration-300" required>
                </div>
                <div data-aos="fade-up" data-aos-delay="600">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-2 border-transparent focus:border-[#702D8E] focus:bg-white focus:ring-0 transition duration-300" required>
                </div>

                <button type="submit" class="w-full py-5 bg-[#702D8E] text-white rounded-2xl font-black text-lg shadow-xl shadow-purple-100 hover:bg-purple-800 transition transform hover:-translate-y-2 active:scale-95 mt-4" data-aos="zoom-in" data-aos-delay="700">
                    GABUNG SEKARANG
                </button>

                <p class="text-center text-gray-500 font-medium mt-6" data-aos="fade-up" data-aos-delay="800">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-[#702D8E] font-black hover:underline transition">Masuk Login</a>
                </p>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0% { transform: translateY(0px) rotate(12deg); }
        50% { transform: translateY(-20px) rotate(20deg); }
        100% { transform: translateY(0px) rotate(12deg); }
    }
    .animate-float {
        animation: float 4s ease-in-out infinite;
    }
</style>
@endsection
