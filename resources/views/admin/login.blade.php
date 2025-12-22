@extends('layouts.app-ngombee')

@section('content')
<div class="pt-32">
    <div class="max-w-md mx-auto p-8 bg-white rounded-2xl shadow-xl" x-data="adminLogin">
        <h2 class="text-2xl font-black mb-6 uppercase tracking-tighter">Login <span class="text-brand-emerald">Admin</span></h2>

        <form @submit.prevent="login">
            <div class="mb-4">
                <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Email Address</label>
                <input type="email" x-model="email" placeholder="Email" class="w-full p-4 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-brand-emerald">
            </div>

            <div class="mb-6">
                <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Password</label>
                <input type="password" x-model="password" placeholder="Password" class="w-full p-4 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-brand-emerald">
            </div>

            <button type="submit" class="w-full bg-gray-900 text-white py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-brand-emerald transition-all shadow-lg">
                Login System
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('adminLogin', () => ({
            email: 'admin@ngombee.com',
            password: 'password123',
            async login() {
                try {
                    const res = await fetch('/api/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            email: this.email,
                            password: this.password
                        })
                    });

                    const data = await res.json();

                    if (res.ok && data.token) {
                        // Simpan token untuk API berikutnya
                        localStorage.setItem('ngombee_admin_token', data.token);

                        // Berikan feedback visual sedikit sebelum pindah
                        alert('Login Berhasil! Mengalihkan ke Dashboard...');
                        window.location.href = '/admin/dashboard';
                    } else {
                        alert('Gagal login: ' + (data.message || 'Cek email/password'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan koneksi ke server.');
                }
            }
        }));
    });
</script>
@endsection
