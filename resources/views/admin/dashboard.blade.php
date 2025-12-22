@extends('layouts.app-ngombee')

@section('title', 'Admin Dashboard - Ngombee')

@section('content')
<div class="pt-32 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="text-center md:text-left">
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">
                    ADMIN <span class="text-brand-emerald italic uppercase">DASHBOARD</span>
                </h1>
                <p class="text-gray-500 font-medium text-sm">Sistem Manajemen Inventaris Ngombee.</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-rose-500 text-white px-8 py-3 rounded-2xl font-black text-xs uppercase shadow-lg shadow-rose-100 hover:bg-rose-600 transition-all">
                    LOGOUT SYSTEM
                </button>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Produk</h3>
                <p class="text-3xl font-black text-gray-900">{{ $products->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Kategori</h3>
                <p class="text-3xl font-black text-blue-600">{{ $categories->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Stok</h3>
                <p class="text-3xl font-black text-brand-emerald">{{ $totalStock }}</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Stok Habis</h3>
                <p class="text-3xl font-black text-rose-500">{{ $outOfStock }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-gray-100 sticky top-32">
                    <h2 class="text-xl font-black mb-6">Tambah Produk</h2>
                    <form method="POST" action="{{ route('admin.products.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Nama Produk</label>
                            <input type="text" name="name" required class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-brand-emerald">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Harga</label>
                                <input type="number" name="price" required class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-brand-emerald">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Stok</label>
                                <input type="number" name="stock" required class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-brand-emerald">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Kategori</label>
                            <select name="category_id" required class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold focus:ring-2 focus:ring-brand-emerald">
                                <option value="">Pilih...</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-gray-900 text-white p-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-brand-emerald transition-all shadow-lg mt-2">
                            Simpan Produk
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <h2 class="text-2xl font-black mb-6 italic">Daftar Menu</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($products as $product)
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-[9px] font-black uppercase px-2 py-1 bg-gray-100 rounded text-gray-500">
                                    {{ $product->category?->name ?? 'None' }}
                                </span>
                                <h3 class="font-black text-xl text-gray-900 mt-1">{{ $product->name }}</h3>
                            </div>
                            <p class="font-black text-brand-emerald italic">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-50">
                            <span class="text-xs font-bold text-gray-400 uppercase">Stok: <span class="text-gray-900">{{ $product->stock }}</span></span>
                            <div class="flex gap-4">
                                <button onclick="openEditModal({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->stock }}, {{ $product->category_id }})"
                                    class="text-[10px] font-black uppercase text-blue-500 hover:underline">Edit</button>

                                <form method="POST" action="{{ route('admin.products.delete', $product->id) }}" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-[10px] font-black uppercase text-rose-400 hover:text-rose-600">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 z-[150] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeEditModal()"></div>
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md p-8 rounded-[2.5rem] shadow-2xl">
            <h3 class="text-2xl font-black mb-6 text-gray-900 uppercase">Edit <span class="text-brand-emerald">Produk</span></h3>
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id">
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Nama Produk</label>
                    <input type="text" name="name" id="editName" required class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold text-gray-900">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Harga</label>
                        <input type="number" name="price" id="editPrice" required class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold text-gray-900">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Stok</label>
                        <input type="number" name="stock" id="editStock" required class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold text-gray-900">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 ml-1">Kategori</label>
                    <select name="category_id" id="editCategory" required class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold text-gray-900">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-100 text-gray-500 py-4 rounded-2xl font-black uppercase text-xs">Batal</button>
                    <button type="submit" class="flex-1 bg-brand-emerald text-white py-4 rounded-2xl font-black uppercase text-xs shadow-lg shadow-emerald-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, name, price, stock, categoryId) {
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editPrice').value = price;
        document.getElementById('editStock').value = stock;
        document.getElementById('editCategory').value = categoryId;
        document.getElementById('editForm').action = `/admin/products/${id}`;
        document.getElementById('editModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection
