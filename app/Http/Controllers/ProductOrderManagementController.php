<?php

namespace App\Http\Controllers;

use App\Enums\ProductOrderStatus;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class ProductOrderManagementController extends Controller
{
    public function index()
    {
        $productOrders = ProductOrder::latest()->get();
        return view('admin.manage-product-order')
            ->with('productOrders', $productOrders);
    }

    public function confirmPayment(ProductOrder $productOrder)
    {
        $productOrder->update(['status' => ProductOrderStatus::MENUNGGU_RESI]);
        return redirect()->back()
            ->with('success', 'Pembayaran pesanan (Order ID: '.$productOrder->id.') berhasil dikonfirmasi.');
    }

    public function updateResi(ProductOrder $productOrder, Request $request)
    {
        $this->validate($request, [
            "nomor_resi" => ["required", "numeric"],
        ]);
        $productOrder->update(['nomor_resi' => $request->nomor_resi, 'status' => ProductOrderStatus::SEDANG_DIKIRIM]);
        return redirect()->back()
            ->with('success', 'Resi (Order ID: '.$productOrder->id.') berhasil diperbarui.');
    }
}
