@extends('layouts.app-ngombee')

@section('content')
<section class="py-32 bg-white overflow-hidden min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2" data-aos="fade-up">
                <h2 class="text-brand-emerald font-black text-2xl mb-4 uppercase tracking-[0.2em]">Our Story</h2>
                <h1 class="text-6xl font-black text-gray-900 mb-8 leading-none">
                    Tentang <br><span class="text-brand-emerald italic">Ngombee Indonesia</span>
                </h1>
                <div class="space-y-6 text-gray-600 text-lg leading-relaxed">
                    <p>
                        Ngombe merupakan penyedia minuman <em>brewed tea</em> dan kopi kekinian yang menghadirkan lebih dari 50 varian rasa. Kami percaya bahwa minuman bukan sekadar pelepas dahaga, tapi teman perjalanan hari Anda.
                    </p>
                    <p class="border-l-8 border-brand-emerald pl-6 font-bold text-gray-800 text-2xl italic">
                        "Kami percaya bahwa setiap tegukan adalah cerita. Itulah mengapa kami hanya menggunakan bahan-bahan segar pilihan."
                    </p>
                </div>

                <div class="mt-12 grid grid-cols-2 gap-8">
                    <div class="bg-brand-light p-6 rounded-3xl">
                        <div class="text-4xl font-black text-brand-emerald">500+</div>
                        <div class="text-gray-500 font-bold uppercase text-sm tracking-widest">Outlet Resmi</div>
                    </div>
                    <div class="bg-brand-light p-6 rounded-3xl">
                        <div class="text-4xl font-black text-brand-emerald">100%</div>
                        <div class="text-gray-500 font-bold uppercase text-sm tracking-widest">Bahan Alami</div>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 relative h-[600px] flex items-center justify-center" data-aos="fade-left">
                <div class="absolute w-[120%] h-[120%] bg-brand-emerald/5 rounded-full filter blur-3xl animate-pulse"></div>

                <div class="relative z-10 grid grid-cols-3 gap-6 w-full items-end">
                    <!-- ✅ Gelas Kiri -->
                    <div class="bg-white rounded-[40px] h-72 flex items-center justify-center transform -rotate-12 translate-y-10 shadow-lg group hover:scale-110 transition duration-500 overflow-hidden">
                        <img src="{{ asset('images/about-glass-1.jpg') }}"
                             alt="Minuman Ngombee 1"
                             class="w-full h-full object-cover">
                    </div>

                    <!-- ✅ Gelas Tengah (Best Seller) -->
                    <div class="bg-white rounded-[50px] h-96 border-4 border-brand-emerald flex items-center justify-center z-20 shadow-2xl transform hover:-translate-y-4 transition duration-500 relative overflow-hidden">
                        <!-- 💥 Badge BEST SELLER — diperbesar & diposisikan tepat -->
                        <div class="absolute top-2 right-2 bg-brand-emerald text-white px-3 py-1 rounded-full font-black text-xs sm:text-sm z-10">
                            BEST SELLER
                        </div>
                        <img src="{{ asset('images/about-glass-2.jpg') }}"
                             alt="Minuman Ngombee Best Seller"
                             class="w-full h-full object-cover">
                    </div>

                    <!-- ✅ Gelas Kanan -->
                    <div class="bg-white rounded-[40px] h-72 flex items-center justify-center transform rotate-12 translate-y-10 shadow-lg group hover:scale-110 transition duration-500 overflow-hidden">
                        <img src="{{ asset('images/about-glass-3.jpg') }}"
                             alt="Minuman Ngombee 3"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
