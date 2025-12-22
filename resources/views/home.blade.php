@extends('layouts.app-ngombee')

@section('title', 'Ngombee - Home')

@section('content')
    <section class="pt-32 pb-20 bg-brand-light relative overflow-hidden min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2" data-aos="fade-right">
                <h1 class="text-6xl md:text-8xl font-black leading-tight mb-6 text-gray-900">
                    Segarkan Harimu <br><span class="text-brand-emerald">Setiap Saat.</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10 max-w-lg leading-relaxed">
                    Ngombee hadir dengan bahan premium terbaik untuk menciptakan momen spesial di setiap tegukan Anda. Kami percaya kebahagiaan dimulai dari gelas yang tepat.
                </p>
                <div class="flex space-x-4">
                    <a href="{{ route('menu') }}" class="bg-brand-emerald text-white px-10 py-5 rounded-2xl font-black text-lg shadow-xl shadow-emerald-200 hover:scale-105 transition transform flex items-center justify-center">
                        PESAN SEKARANG
                    </a>
                    <a href="{{ route('about') }}" class="border-2 border-brand-emerald text-brand-emerald px-10 py-5 rounded-2xl font-black text-lg hover:bg-brand-emerald hover:text-white transition">
                        OUR STORY
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 mt-12 md:mt-0 relative" data-aos="zoom-in">
                <div class="w-full h-[600px] bg-white rounded-[60px] flex items-center justify-center border-4 border-dashed border-emerald-200 relative overflow-hidden">
                    <!-- 🟢 GAMBAR AKAN MUNCUL OTOMATIS JIKA FILE ADA -->
                    <img src="{{ asset('images/hero-ngombee.jpg') }}"
                         alt="Minuman Premium Ngombee"
                         class="w-full h-full object-cover rounded-[40px]">
                </div>
                <div class="absolute -top-10 -right-10 text-6xl animate-bounce">🍃</div>
                <div class="absolute -bottom-10 -left-10 text-6xl animate-bounce delay-700">🌿</div>
            </div>
        </div>
    </section>
@endsection
