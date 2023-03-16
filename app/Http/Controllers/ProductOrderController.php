<?php

namespace App\Http\Controllers;

use App\Enums\ProductOrderStatus;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductOrderController extends Controller
{
    public function index()
    {
//        dd(ProductOrder::where('user_id', auth()->user()->id)->latest()->get());
//        dd(ProductOrderStatus::getKeys());
//        dd(ProductOrderStatus::getKey(ProductOrderStatus::MENUNGGU_DIBAYAR));

        $thisUserProductOrders = ProductOrder::where('user_id', auth()->user()->id)->latest()->get();
        return view('order-history-product')
            ->with('productOrders', $thisUserProductOrders);
    }

    public function update(ProductOrder $productOrder, Request $request)
    {
        $this->validate($request, [
            "nama_pembayar" => ["required"],
            "bukti_pembayaran" => ["required", "image", "file", "max:1024", "mimes:jpeg,png,jpg"],
        ]);

        /* productOrder actually owned by this user */
        if ($productOrder->user->id != auth()->user()->id) {
            // TODO: add error tambah bukti pembayaran order ini bukan milik current user
            return 'error: this order isn\'t yours';
        }

        $bukti_pembayaran = $productOrder->bukti_pembayaran;
        if (isset($bukti_pembayaran) && File::exists($bukti_pembayaran->path)) {
            $destination = $bukti_pembayaran->path;
            File::delete($destination);
        }
        $photoPath = $request
            ->file('bukti_pembayaran')
            ->store('photo/bukti_pembayaran', 'public_direct');
        $productOrder->bukti_pembayaran()->updateOrCreate([], ['path' => $photoPath]);
        $productOrder->update([
            'nama_pembayar' => $request->nama_pembayar,
            'status' => ProductOrderStatus::MENUNGGU_VERIFIKASI
        ]);
        return redirect('/order-history-product')
            ->with('success', 'Upload bukti pembayaran berhasil (Order ID: '.$productOrder->id.')');
    }

    public function cancel(ProductOrder $productOrder)
    {
        if ($productOrder->user->id != auth()->user()->id) {
            // TODO: add error cancel order order ini bukan milik current user
            return 'error: this order isn\'t yours';
        }
        $productOrder->update(['status' => ProductOrderStatus::DIBATALKAN]);
        return redirect('/order-history-product')
            ->with('success', 'Order berhasil dibatalkan (Order ID: '.$productOrder->id.')');
    }

    public function track(ProductOrder $productOrder, Request $request)
    {
        $isThisUserProductOrder = $productOrder->user->id == auth()->user()->id;
        $isThisProductOrderHasResi = isset($productOrder->nomor_resi);
        if (!$isThisUserProductOrder || !$isThisProductOrderHasResi) {
            // TODO: add 404 page track
            return "404 (not your order (or) not have nomor_resi)";
        }
        return view('track')
            ->with('nomor_resi', $productOrder->nomor_resi);
    }
}
