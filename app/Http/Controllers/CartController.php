<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductStackCart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
//        dd(ProductStackCart::where('cart_id', auth()->user()->cart->id)->get());
        return view('cart')
            ->with('productStackCarts', ProductStackCart::where('cart_id', auth()->user()->cart->id)->get());
    }

    public function store(Request $request)
    {
//        return response()->json($request->all());
        $this->validate($request, [
            "product_id" => ["required", "exists:products,id"],
            "kuantitas" => ["required", "numeric", "min:1"],
        ]);
        $product = Product::find($request->product_id);
        if ($product->stok < $request->kuantitas) {
            return response()->json([
                'error' => true,
                'message' => 'Stok produk sudah habis.'
            ]);
        }

        // get or create productStackCart
        $cart = auth()->user()->cart;
        $productStackCart = ProductStackCart::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();
        if (empty($productStackCart)) {
            $productStackCart = ProductStackCart::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id
            ]);
        }

        // handle stack quantity overflow
        if ($productStackCart->kuantitas + $request->kuantitas > $product->stok) {
            $productStackCart->kuantitas = $product->stok;
        } else {
            $productStackCart->kuantitas += $request->kuantitas;
        }
        $productStackCart->save();

        return response()->json([
            'error' => false,
            'message' => 'Produk berhasil ditambahkan ke keranjang.'
        ]);
    }
}
