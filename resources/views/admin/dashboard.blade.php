@extends('layouts.app-ngombee')

@section('title', 'Admin Dashboard - Ngombee')

@section('content')
<div class="pt-32 pb-20 bg-gray-50 min-h-screen" x-data="adminDashboard()">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-4xl font-black">ADMIN <span class="text-brand-emerald">DASHBOARD</span></h1>
            <button @click="logout" class="bg-rose-500 text-white px-6 py-2 rounded-xl">Logout</button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Total Produk</p>
                <p class="text-2xl font-black" x-text="products.length"></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Total Stok</p>
                <p class="text-2xl font-black text-brand-emerald" x-text="totalStock"></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Stok Habis</p>
                <p class="text-2xl font-black text-rose-500" x-text="outOfStock"></p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div>
                <h2 class="text-xl font-bold mb-4" x-text="editMode ? 'Edit Produk' : 'Tambah Produk'"></h2>
                <form @submit.prevent="submitProduct" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="space-y-4">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Nama Produk</label>
                            <input type="text" x-model="formData.name" placeholder="Contoh: Matcha Latte" class="w-full p-3 bg-gray-50 border-none rounded-xl mt-1 focus:ring-2 focus:ring-brand-emerald">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Harga (Rp)</label>
                            <input type="number" x-model="formData.price" placeholder="0" class="w-full p-3 bg-gray-50 border-none rounded-xl mt-1 focus:ring-2 focus:ring-brand-emerald">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Jumlah Stok</label>
                            <input type="number" x-model="formData.stock" placeholder="0" class="w-full p-3 bg-gray-50 border-none rounded-xl mt-1 focus:ring-2 focus:ring-brand-emerald">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Kategori</label>
                            <select x-model="formData.category_id" class="w-full p-3 bg-gray-50 border-none rounded-xl mt-1 focus:ring-2 focus:ring-brand-emerald">
                                <option value="">Pilih Kategori</option>
                                <template x-for="cat in categories" :key="cat.id">
                                    <option :value="cat.id" x-text="cat.name"></option>
                                </template>
                            </select>
                        </div>

                        <div class="pt-4 flex gap-2">
                            <button type="submit"
                                    class="flex-1 bg-brand-emerald text-white py-3 rounded-xl font-bold shadow-lg shadow-emerald-100 transition-all hover:scale-[1.02] active:scale-95"
                                    x-text="editMode ? 'Update Produk' : 'Simpan Produk'">
                            </button>
                            <button type="button"
                                    x-show="editMode"
                                    @click="resetForm"
                                    class="bg-gray-100 text-gray-500 px-4 rounded-xl font-bold">
                                Batal
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-2">
                <h2 class="text-xl font-bold mb-4">Daftar Produk</h2>
                <div class="grid gap-4">
                    <template x-for="product in products" :key="product.id">
                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center transition-hover hover:border-brand-emerald">
                            <div>
                                <h3 class="font-bold text-gray-900" x-text="product.name"></h3>
                                <div class="flex gap-4 mt-1">
                                    <p class="text-sm text-gray-500">Rp <span x-text="parseInt(product.price).toLocaleString('id-ID')"></span></p>
                                    <p class="text-sm font-medium" :class="product.stock > 0 ? 'text-brand-emerald' : 'text-rose-500'">
                                        Stok: <span x-text="product.stock"></span>
                                    </p>
                                </div>
                                <span class="text-[10px] bg-gray-100 px-2 py-1 rounded text-gray-400 uppercase font-bold mt-2 inline-block" x-text="product.category ? product.category.name : 'No Category'"></span>
                            </div>
                            <div class="flex gap-2">
                                <button @click="startEdit(product)" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button @click="deleteProduct(product.id)" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function adminDashboard() {
        return {
            products: [],
            categories: [],
            totalStock: 0,
            outOfStock: 0,

            // Variabel Form
            formData: { id: null, name: '', price: '', stock: '', category_id: '' },
            editMode: false,

            async init() {
                await this.loadDashboard();
            },

            async loadDashboard() {
                const token = localStorage.getItem('ngombee_token');
                if (!token) return this.logout();

                try {
                    const res = await fetch('/api/admin/dashboard', {
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        }
                    });
                    if (!res.ok) throw new Error('Unauthorized');

                    const data = await res.json();
                    this.products = data.products;
                    this.categories = data.categories;
                    this.totalStock = data.totalStock;
                    this.outOfStock = data.outOfStock;
                } catch (e) {
                    console.error("Gagal load dashboard", e);
                }
            },

            // Masuk ke Mode Edit
            startEdit(product) {
                this.editMode = true;
                this.formData = {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    stock: product.stock,
                    category_id: product.category_id
                };
                window.scrollTo({ top: 0, behavior: 'smooth' });
            },

            // Reset Form ke awal
            resetForm() {
                this.editMode = false;
                this.formData = { id: null, name: '', price: '', stock: '', category_id: '' };
            },

            // Fungsi Simpan (Bisa Create atau Update)
            async submitProduct() {
                const token = localStorage.getItem('ngombee_token');
                if (!this.formData.category_id) return alert('Pilih kategori dulu!');

                // Tentukan URL & Method (POST untuk baru, PUT untuk update)
                const url = this.editMode ? `/api/admin/products/${this.formData.id}` : '/api/admin/products';
                const method = this.editMode ? 'PUT' : 'POST';

                try {
                    const res = await fetch(url, {
                        method: method,
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.formData)
                    });

                    const data = await res.json();

                    if (res.ok && data.success) {
                        alert(this.editMode ? 'Berhasil diperbarui!' : 'Berhasil ditambah!');
                        this.resetForm();
                        await this.loadDashboard();
                    } else {
                        // Tampilkan error validasi jika ada (Penyebab 422)
                        const errorMsg = data.errors ? Object.values(data.errors).flat().join('\n') : data.message;
                        alert("Gagal: " + errorMsg);
                    }
                } catch (e) {
                    alert('Terjadi kesalahan server');
                }
            },

            async deleteProduct(id) {
                if (!confirm('Hapus produk ini?')) return;
                const token = localStorage.getItem('ngombee_token');
                try {
                    const res = await fetch(`/api/admin/products/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        }
                    });
                    const data = await res.json();
                    if (data.success) await this.loadDashboard();
                } catch (e) {
                    alert('Gagal menghapus');
                }
            },

            logout() {
                localStorage.removeItem('ngombee_token');
                localStorage.removeItem('ngombee_user');
                window.location.href = '/';
            }
        }
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('adminDashboard', adminDashboard);
    });
</script>
@endsection
