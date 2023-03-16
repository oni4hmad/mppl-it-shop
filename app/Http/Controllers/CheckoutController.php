<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductStackCart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartId = auth()->user()->cart->id;
        $checkedProductStackCarts = ProductStackCart::where('cart_id', $cartId)
            ->with('product')
            ->where('checked', true)
            ->get();

        // TODO: handle error Checkout: No items found
        if (count($checkedProductStackCarts) <= 0) {
            return "No items found.";
        }
        $couriers = Courier::with('courier_types')->get();
        $payment_methods = PaymentMethod::all();
        return view('checkout')
            ->with('checkedProductStackCarts', $checkedProductStackCarts)
            ->with('checkedProductStackCarts_json', json_encode($checkedProductStackCarts))
            ->with('payment_methods', $payment_methods)
            ->with('couriers', $couriers)
            ->with('couriers_json', json_encode($couriers));
    }

    public function directCheckout(Product $product, Request $request)
    {
        $this->validate($request, [
            "kuantitas" => ["required", "numeric", "min:1"],
        ]);

        // check if product stock still available
        if ($product->stok < $request->kuantitas) {
            return redirect()->back()
                ->with('error', 'Checkout gagal: stok produk habis.');
        }

        // uncheck all items in cart
        auth()->user()->cart->productStackCarts()->update(['checked' => false]);

        // check if this user cart has the current product or not
        $thisProductStackCart = auth()->user()->cart->productStackCarts->where('product_id', $product->id)->first();
        if ($thisProductStackCart->count() > 0) {
            $thisProductStackCart->update([
                'kuantitas' => $request->kuantitas,
                'checked' => true,
            ]);
        } else {
            auth()->user()->cart->productStackCarts()->create([
                'product_id' => $product->id,
                'kuantitas' => $request->kuantitas,
                'checked' => true,
            ]);
        }

        return redirect('/checkout');
    }
}
