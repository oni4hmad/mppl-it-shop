<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\PaymentMethod;
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
}
