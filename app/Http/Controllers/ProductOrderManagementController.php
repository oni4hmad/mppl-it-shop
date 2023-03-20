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
        /* memastikan product order masih MENUNGGU_VERIFIKASI */
        if ($productOrder->status != ProductOrderStatus::MENUNGGU_VERIFIKASI) {
            return redirect()->back()
                ->with('error', 'Gagal melakukan konfirmasi pembayaran: status mengalami perubahan.');
        }

        $productOrder->update(['status' => ProductOrderStatus::MENUNGGU_RESI]);
        return redirect()->back()
            ->with('success', 'Pembayaran pesanan (Order ID: '.$productOrder->id.') berhasil dikonfirmasi.');
    }

    public function updateResi(ProductOrder $productOrder, Request $request)
    {
        $this->validate($request, [
            "nomor_resi" => ["required", "numeric"],
        ]);

        /* memastikan product order masih MENUNGG_RESI */
        if ($productOrder->status != ProductOrderStatus::MENUNGGU_VERIFIKASI) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan resi: status mengalami perubahan.');
        }

        $productOrder->update(['nomor_resi' => $request->nomor_resi, 'status' => ProductOrderStatus::SEDANG_DIKIRIM]);
        return redirect()->back()
            ->with('success', 'Resi (Order ID: '.$productOrder->id.') berhasil diperbarui.');
    }
}
