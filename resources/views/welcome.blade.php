@extends('layouts.app-ngombee')

@section('content')
    <section class="pt-32 pb-20 bg-brand-light relative overflow-hidden min-h-screen flex items-center">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-brand-emerald/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-emerald-200/20 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center relative z-10">
            <div class="md:w-1/2" data-aos="fade-right">
                <span class="bg-brand-emerald/10 text-brand-emerald px-4 py-2 rounded-full font-bold text-sm uppercase tracking-widest mb-6 inline-block">Premium Brewed Tea</span>
                <h1 class="text-6xl md:text-8xl font-black leading-tight mb-6 text-gray-900">
                    Segarkan Harimu <br><span class="text-brand-emerald">Setiap Saat.</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10 max-w-lg leading-relaxed">
                    Ngombe hadir dengan bahan premium terbaik untuk menciptakan momen spesial di setiap tegukan Anda. Kami percaya kebahagiaan dimulai dari gelas yang tepat.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('menu') }}" class="bg-brand-emerald text-white px-10 py-5 rounded-2xl font-black text-lg shadow-xl shadow-emerald-200 hover:scale-105 transition transform flex items-center gap-2">
                        LIHAT MENU
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="{{ route('about') }}" class="border-2 border-brand-emerald text-brand-emerald px-10 py-5 rounded-2xl font-black text-lg hover:bg-brand-emerald hover:text-white transition">OUR STORY</a>
                </div>
            </div>

            <div class="md:w-1/2 mt-12 md:mt-0 relative" data-aos="zoom-in" data-aos-delay="200">
                <div class="w-full h-[550px] bg-emerald-100 rounded-[80px] flex items-center justify-center border-4 border-dashed border-brand-emerald relative group overflow-hidden">
                    <div class="text-center">
                        <span class="text-brand-emerald font-black text-2xl uppercase block mb-2">[FOTO HERO UTAMA PNG]</span>
                        <p class="text-brand-emerald/60 text-sm italic">Gelas besar dengan embun air & es batu</p>
                    </div>
                    <div class="absolute top-10 right-10 text-6xl animate-float">🍃</div>
                    <div class="absolute bottom-10 left-10 text-6xl animate-float" style="animation-delay: 1s">🌿</div>
                </div>
            </div>
        </div>
    </section>
@endsection
