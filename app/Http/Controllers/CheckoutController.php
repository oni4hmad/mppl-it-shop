<?php

namespace App\Http\Controllers;

use App\Models\ProductStackCart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkedProductStackCart = auth()->user()->cart->productStackCarts->where('checked', true);
        if (count($checkedProductStackCart) <= 0) {
            return "No items found.";
        }
        return view('checkout');
    }
}
