<?php

namespace App\Http\Controllers;

use App\Enums\ProductOrderStatus;
use App\Enums\UserType;
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

    public function uploadPaymentEvidence(ProductOrder $productOrder, Request $request)
    {
        $this->validate($request, [
            "nama_pembayar" => ["required"],
            "bukti_pembayaran" => ["required", "image", "file", "max:1024", "mimes:jpeg,png,jpg"],
        ]);

        /* productOrder actually owned by this user */
        if ($productOrder->user->id != auth()->user()->id) {
            // error tambah bukti pembayaran order ini bukan milik current user
            return abort(404);
        }

        /* memastikan product order masih MENUNGGU_PEMBAYARAN / MENUNGG_VERIFIKASI */
        if ($productOrder->status != ProductOrderStatus::MENUNGGU_PEMBAYARAN
            && $productOrder->status != ProductOrderStatus::MENUNGGU_VERIFIKASI) {
            return redirect()->back()
                ->with('error', 'Upload gagal: status tidak sedang menunggu pembayaran.');
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

    // for admin
    public function rejectOrder(ProductOrder $productOrder)
    {
        /* memastikan this user = admin */
        $isThisUserAdmin = auth()->user()->user_type == UserType::ADMINISTRATOR;
        if (!$isThisUserAdmin) {
            return abort(404);
        }

        /* memastikan prodcut order masih MENUNGGU_PEMBAYARAN / MENUNGGU_VERIFIKASI */
        $isOrderWaitingPayment = $productOrder->status == ProductOrderStatus::MENUNGGU_PEMBAYARAN;
        $isOrderWaitVerification = $productOrder->status == ProductOrderStatus::MENUNGGU_VERIFIKASI;
        if (!$isOrderWaitingPayment && !$isOrderWaitVerification) {
            return redirect()->back()
                ->with('error', 'Gagal membatalkan pesanan produk: status mengalami perubahan.');
        }

        /* eksekusi penolakan */
        return $this->cancel($productOrder);
    }

    // for user
    public function cancelOrder(ProductOrder $productOrder)
    {
        /* memastikan orderan dari this user */
        $isThisUserProductOrder = $productOrder->user->id == auth()->user()->id;
        if (!$isThisUserProductOrder) {
            return abort(404);
        }

        /* memastikan product order masih MENUNGGU_PEMBAYARAN */
        $isOrderWaitingPayment = $productOrder->status == ProductOrderStatus::MENUNGGU_PEMBAYARAN;
        if (!$isOrderWaitingPayment) {
            return redirect()->back()
                ->with('error', 'Gagal membatalkan pesanan produk: status mengalami perubahan.');
        }

        /* eksekusi pembatalan */
        return $this->cancel($productOrder);
    }

    private function cancel(ProductOrder $productOrder)
    {
        /* jika status MENUNGGU_VERIFIKASI maka hapus bukti_pembayaran (record dan file) */
        if ($productOrder->status == ProductOrderStatus::MENUNGGU_VERIFIKASI) {
            if (File::exists($productOrder->bukti_pembayaran->path)) {
                $destination = $productOrder->bukti_pembayaran->path;
                File::delete($destination);
            }
            $productOrder->bukti_pembayaran->delete();
        }

        $productOrder->update(['status' => ProductOrderStatus::DIBATALKAN]);
        return redirect()->back()
            ->with('success', 'Order berhasil dibatalkan (Order ID: '.$productOrder->id.')');
    }

    public function track(ProductOrder $productOrder, Request $request)
    {
        $isThisUserProductOrder = $productOrder->user->id == auth()->user()->id;
        $isThisUserAdmin = auth()->user()->user_type == UserType::ADMINISTRATOR;
        $isThisProductOrderHasResi = isset($productOrder->nomor_resi);
        if ((!$isThisUserProductOrder && !$isThisUserAdmin) || !$isThisProductOrderHasResi) {
            return abort(404);
        }
        return view('track')
            ->with('nomor_resi', $productOrder->nomor_resi);
    }

    public function markDone(ProductOrder $productOrder)
    {
        $isThisUserProductOrder = $productOrder->user->id == auth()->user()->id;
        $isThisUserAdmin = auth()->user()->user_type == UserType::ADMINISTRATOR;
        $isThisProductOrderHasResi = isset($productOrder->nomor_resi);
        if ((!$isThisUserProductOrder && !$isThisUserAdmin) || !$isThisProductOrderHasResi) {
            return abort(404);
        }

        /* memastikan product order masih SEDANG_DIKIRIM */
        if ($productOrder->status != ProductOrderStatus::SEDANG_DIKIRIM) {
            return redirect()->back()
                ->with('error', 'Gagal melakukan konfirmasi selesai: status mengalami perubahan.');
        }

        $productOrder->update(['status' => ProductOrderStatus::ORDER_SELESAI]);
        return redirect()->back()
            ->with('success', 'Berhasil mengonfirmasi produk telah selesai diterima. (Order ID: '.$productOrder->id.')');
    }
}
