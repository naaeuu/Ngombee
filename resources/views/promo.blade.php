@extends('layouts.app-ngombee')

@section('content')
<div class="pt-32 pb-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-5xl font-black text-[#702D8E] italic tracking-tighter mb-4">PROMO & NEWS</h2>
            <div class="w-24 h-2 bg-brand-emerald mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="group relative bg-gradient-to-br from-orange-400 to-red-500 rounded-[40px] p-10 text-white h-[500px] shadow-2xl overflow-hidden hover:scale-[1.02] transition duration-500" data-aos="fade-right" data-aos-delay="100">
                <div class="relative z-10">
                    <h3 class="text-4xl font-black mb-6">Special<br>Promo</h3>
                    <button class="bg-brand-emerald text-white px-8 py-3 rounded-full font-black text-sm uppercase tracking-widest hover:bg-white hover:text-brand-emerald transition shadow-lg">More Info</button>
                </div>
                <div class="absolute bottom-[-50px] right-[-20px] w-64 h-80 opacity-90 group-hover:rotate-6 transition duration-700">
                     <span class="text-8xl">🧋</span> </div>
            </div>

            <div class="group relative bg-gradient-to-br from-emerald-400 to-teal-600 rounded-[40px] p-10 text-white h-[500px] shadow-2xl overflow-hidden hover:scale-[1.02] transition duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="relative z-10 text-center">
                    <h3 class="text-4xl font-black mb-6">News and<br>Event</h3>
                    <button class="bg-white text-emerald-600 px-8 py-3 rounded-full font-black text-sm uppercase tracking-widest hover:bg-emerald-100 transition shadow-lg">Discover</button>
                </div>
                <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-[150px] opacity-20 group-hover:scale-125 transition duration-700">📢</div>
            </div>

            <div class="group relative bg-gradient-to-br from-purple-600 to-[#702D8E] rounded-[40px] p-10 text-white h-[500px] shadow-2xl overflow-hidden hover:scale-[1.02] transition duration-500" data-aos="fade-left" data-aos-delay="300">
                <div class="relative z-10">
                    <h3 class="text-4xl font-black mb-6">Find Our<br>Outlet</h3>
                    <a href="{{ route('store') }}"
                        class="inline-block bg-brand-emerald text-white px-8 py-3 rounded-full font-black text-sm uppercase tracking-widest hover:bg-white hover:text-brand-emerald transition shadow-lg text-center">
                        Check Map
                    </a>
                </div>
                <div class="absolute bottom-10 right-10 text-[120px] opacity-30 group-hover:-translate-y-5 transition duration-700">📍</div>
            </div>
        </div>

        <div class="bg-[#702D8E] rounded-[50px] p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8 mt-20 shadow-3xl" data-aos="zoom-in">
            <div class="md:w-1/2">
                <h3 class="text-4xl font-black mb-2">Get in touch with us</h3>
                <p class="text-purple-200">Subscribe for updated promo, news and events.</p>
            </div>
            <div class="md:w-1/2 w-full flex bg-white rounded-full p-2">
                <input type="email" placeholder="Your Email" class="bg-transparent border-none text-gray-800 w-full px-6 focus:ring-0">
                <button class="bg-brand-emerald text-white px-8 py-4 rounded-full font-black uppercase tracking-wider hover:bg-emerald-600 transition">Subscribe</button>
            </div>
        </div>
    </div>
</div>
@endsection
