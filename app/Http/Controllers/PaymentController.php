<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(ProductOrder $productOrder)
    {
        if ($productOrder->user->id != auth()->user()->id) {
            // TODO: add 404 page payment not your order
            return "404 (not your order)";
        }
        $productOrderId = $productOrder->id;
        return view('payment')
            ->with('productOrder', ProductOrder::with('product_stack_orders')->find($productOrderId));
    }
}
