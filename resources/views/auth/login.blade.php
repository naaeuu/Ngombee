@extends('layouts.app-ngombee')

@section('content')
<div class="pt-32 max-w-md mx-auto p-8 bg-white rounded-2xl">
    <h2 class="text-2xl font-black mb-6">Login</h2>
    <form x-data="loginForm()" @submit.prevent="login">
        <input type="email" x-model="email" placeholder="Email" class="w-full p-3 border rounded mb-4">
        <input type="password" x-model="password" placeholder="Password" class="w-full p-3 border rounded mb-4">
        <button type="submit" class="w-full bg-brand-emerald text-white py-3 rounded-xl font-black">Login</button>
    </form>
</div>

<script>
    function loginForm() {
        return {
            email: '',
            password: '',
            async login() {
                try {
                    const res = await fetch('/api/login', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            email: this.email,
                            password: this.password
                        })
                    });

                    const data = await res.json();

                    // ✅ Cek apakah user ada
                    if (data.success && data.token && data.user) {
                        localStorage.setItem('ngombee_token', data.token);
                        localStorage.setItem('ngombee_user', JSON.stringify(data.user));

                        if (data.user.role === 'admin') {
                            window.location.href = '/admin/dashboard';
                        } else {
                            window.location.href = '/dashboard';
                        }
                    } else {
                        alert('Login gagal: ' + (data.message || 'Cek email dan password'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan koneksi. Coba lagi.');
                }
            }
        };
    }
</script>
@endsection
