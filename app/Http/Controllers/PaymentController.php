<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(ProductOrder $productOrder)
    {
        if ($productOrder->user->id != auth()->user()->id) {
            return abort(404);
        }
        $productOrderId = $productOrder->id;
        return view('payment')
            ->with('productOrder', ProductOrder::with('product_stack_orders')->find($productOrderId));
    }
}
