<?php

namespace App\Http\Controllers;

use App\Enums\ProductOrderStatus;
use App\Models\Category;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class ProductOrderController extends Controller
{
    public function index()
    {
//        dd(ProductOrder::where('user_id', auth()->user()->id)->latest()->get());
//        dd(ProductOrderStatus::getKeys());
//        dd(ProductOrderStatus::getKey(ProductOrderStatus::MENUNGGU_DIBAYAR));
        return view('order-history-product')
            ->with('productOrders', ProductOrder::where('user_id', auth()->user()->id)->latest()->get());
    }
}
