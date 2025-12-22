@extends('layouts.app-ngombee')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 pt-24 pb-12 px-4 overflow-hidden">
    <div class="max-w-5xl w-full bg-white rounded-[50px] shadow-2xl overflow-hidden flex flex-col md:flex-row border-4 border-white" data-aos="zoom-in" data-aos-duration="800">

        <div class="md:w-1/2 bg-brand-emerald p-12 text-white flex flex-col justify-center relative overflow-hidden">
            <div class="relative z-10">
                <span class="bg-white/20 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-6 inline-block" data-aos="fade-down" data-aos-delay="300">Member Exclusive</span>
                <h2 class="text-5xl font-black mt-4 mb-4 leading-tight" data-aos="fade-right" data-aos-delay="400">Kangen Kesegaran <br><span class="italic text-emerald-200">Ngombee?</span></h2>
                <p class="text-emerald-100 text-lg mb-8" data-aos="fade-up" data-aos-delay="500">Masuk untuk melihat promo spesial dan tukarkan poin dengan minuman favoritmu.</p>


            </div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        </div>

        <div class="md:w-1/2 p-12 bg-white flex flex-col justify-center" data-aos="fade-left" data-aos-delay="200">
            <div class="mb-10">
                <h3 class="text-3xl font-black text-gray-800">Login Member</h3>
                <p class="text-gray-400 mt-2 font-medium">Selamat datang kembali!</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div class="space-y-2" data-aos="fade-up" data-aos-delay="400">
                    <label class="text-xs font-black uppercase tracking-widest text-gray-500 ml-2">Email Address</label>
                    <input type="email" name="email" required class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-2 border-transparent focus:border-brand-emerald focus:bg-white focus:ring-0 transition duration-300" placeholder="nama@email.com">
                </div>

                <div class="space-y-2" data-aos="fade-up" data-aos-delay="500">
                    <label class="text-xs font-black uppercase tracking-widest text-gray-500 ml-2">Password</label>
                    <input type="password" name="password" required class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-2 border-transparent focus:border-brand-emerald focus:bg-white focus:ring-0 transition duration-300" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full py-5 bg-brand-emerald text-white rounded-2xl font-black text-lg shadow-xl shadow-emerald-100 hover:bg-emerald-600 transition transform hover:-translate-y-2 active:scale-95" data-aos="zoom-in" data-aos-delay="600">
                    MASUK SEKARANG
                </button>

                <p class="text-center text-gray-500 font-medium mt-8" data-aos="fade-up" data-aos-delay="700">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-brand-emerald font-black hover:underline transition">Daftar Member</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
