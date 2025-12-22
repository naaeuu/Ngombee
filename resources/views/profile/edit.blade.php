@extends('layouts.app-ngombee')
@section('content')
<div class="pt-32 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4">
        <div class="mb-12 text-center" data-aos="fade-down">
            <h1 class="text-4xl font-black uppercase italic text-gray-900">Pengaturan <span class="text-brand-emerald">Profil</span></h1>
            <p class="text-gray-500 font-bold mt-2">Kelola informasi pribadi dan keamanan akun Ngombee Anda.</p>
        </div>

        <div class="space-y-8">
            <div class="bg-white p-8 md:p-12 rounded-[45px] shadow-sm border border-gray-100">
                <div class="max-w-xl mx-auto">
                    <h2 class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-8">Informasi Akun</h2>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white p-8 md:p-12 rounded-[45px] shadow-sm border border-gray-100">
                <div class="max-w-xl mx-auto">
                    <h2 class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-8">Ganti Password</h2>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-rose-50 p-8 md:p-12 rounded-[45px] border border-rose-100">
                <div class="max-w-xl mx-auto">
                    <h2 class="text-xs font-black uppercase tracking-[0.2em] text-rose-400 mb-8">Zona Bahaya</h2>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom style untuk elemen form bawaan Breeze agar masuk ke tema Ngombee */
    input { @apply rounded-2xl border-gray-100 bg-gray-50 focus:border-brand-emerald focus:ring-brand-emerald !important; }
    button[type="submit"], .bg-gray-800 { @apply bg-brand-emerald text-white px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-gray-900 transition !important; }
    label { @apply text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block !important; }
</style>
@endsection
