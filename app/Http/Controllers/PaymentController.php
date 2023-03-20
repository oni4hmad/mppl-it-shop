<?php

namespace App\Http\Controllers;

use App\Enums\ProductOrderStatus;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(ProductOrder $productOrder)
    {
        if ($productOrder->user->id != auth()->user()->id) {
            return abort(404);
        }

        if ($productOrder->status != ProductOrderStatus::MENUNGGU_PEMBAYARAN) {
            return redirect('/order-history-product');
        }

        $productOrderId = $productOrder->id;
        return view('payment')
            ->with('productOrder', ProductOrder::with('product_stack_orders')->find($productOrderId));
    }
}
