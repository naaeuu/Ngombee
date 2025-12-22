<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        // Jika keranjang kosong, redirect ke menu
        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Keranjang Anda kosong.');
        }

        return view('checkout', compact('cart'));
    }

// app/Http/Controllers/CheckoutController.php

    public function directStore(Request $request)
    {
        // Coba ambil dari request JSON dahulu, jika kosong ambil dari session
        $items = $request->input('items') ?? session()->get('cart', []);

        if (empty($items)) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong.'], 400);
        }

        try {
            DB::beginTransaction();
            $totalOrder = 0;

            foreach ($items as $item) {
                // Pastikan key 'id' dan 'quantity' ada
                $productId = $item['id'] ?? null;
                $qty = $item['quantity'] ?? ($item['qty'] ?? 0); // Handle jika namanya 'qty'

                if (!$productId || $qty <= 0) continue;

                $product = Product::find($productId);
                if (!$product || $product->stock < $qty) {
                    throw new \Exception("Stok " . ($product->name ?? 'Produk') . " tidak cukup!");
                }

                // Kurangi Stok
                $product->decrement('stock', $qty);
                $totalOrder += ($item['price'] ?? $product->price) * $qty;
            }

            Order::create([
                'user_id' => Auth::id(),
                'total' => $totalOrder,
                'status' => 'success'
            ]);

            DB::commit();
            session()->forget('cart');

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
