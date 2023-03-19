<?php

namespace App\Http\Controllers;

use App\Enums\ServiceOrderStatus;
use App\Enums\TechnicianStatus;
use App\Models\ServiceOrder;
use App\Models\Technician;
use Illuminate\Http\Request;

class ServiceOrderManagementController extends Controller
{
    public function index()
    {
        return view('admin.manage-service-order')
            ->with('serviceOrders', ServiceOrder::latest()->get());
    }

    public function sendServiceRequest(Request $request)
    {
//        dd([$request->all()]);

        $this->validate($request, [
            "technician_id" => ["required", "numeric", "exists:technicians,id"],
            "service_order_id" => ["required", "numeric", "exists:service_orders,id"],
        ]);
        // get technician and service order record
        $technician = Technician::find($request->technician_id);
        $serviceOrder = ServiceOrder::find($request->service_order_id);

        // cek status teknisi, pastikan masih tersedia
        if ($technician->status != TechnicianStatus::TERSEDIA) {
            return redirect()->back()
                ->with('error', 'Teknisi yang dipilih sedang tidak tersedia.');
        }

        // cek status order, pastikan masih mencari teknisi
        if ($serviceOrder->status != ServiceOrderStatus::MENCARI_TEKNISI) {
            return redirect()->back()
                ->with('error', 'Status pesanan servis sedang tidak mencari teknisi.');
        }

        // jika ok,
        // ubah status teknisi dan order jadi menunggu konfirmasi
        $technician->status = TechnicianStatus::MENUNGGU_KONFIRMASI;
        $serviceOrder->status = ServiceOrderStatus::MENUNGGU_KONFIRMASI_TEKNISI;

        // associate order dengan teknisi servis
        $serviceOrder->technician()->associate($technician);
        $serviceOrder->save();
        $technician->save();

        return redirect()->back()
            ->with('success', "Permintaan servis berhasil dikirim.");
    }

    public function cancelRequest(Request $request)
    {
        $this->validate($request, [
            "service_order_id" => ["required", "numeric", "exists:service_orders,id"],
        ]);

        // get service order and technician record
        $serviceOrder = ServiceOrder::find($request->service_order_id);
        $technician = $serviceOrder->technician;
//        dd([$serviceOrder, $technician]);

        // cek service order apakah null
        if ($technician == null) {
            return redirect()->back()
                ->with('error', 'Pesanan tidak mempunyai teknisi.');
        }

        // cek status teknisi, pastikan masih menunggu konfirmsai
        // cek status order, pastikan masih menunggu konfirmasi
        if ($technician->status != TechnicianStatus::MENUNGGU_KONFIRMASI
            || $serviceOrder->status != ServiceOrderStatus::MENUNGGU_KONFIRMASI_TEKNISI) {
            return redirect()->back()
                ->with('error', 'Gagal membatalkan permintaan, teknisi sudah melakukan konfirmasi.');
        }

        // jika ok,
        // ubah status teknisi jadi tersedia dan order jadi mencari teknisi
        $technician->status = TechnicianStatus::TERSEDIA;
        $serviceOrder->status = ServiceOrderStatus::MENCARI_TEKNISI;

        // dissociate order dengan teknisi servis
        $serviceOrder->technician()->dissociate();
        $serviceOrder->save();
        $technician->save();

        return redirect()->back()
            ->with('success', "Permintaan servis berhasil dibatalkan.");
    }

    // TODO: add admin permission to cancel/reject the service order
//    public function cancel(ServiceOrder $serviceOrder)
//    {
//        if ($serviceOrder->status != ServiceOrderStatus::MENCARI_TEKNISI) {
//            return abort(404);
//        }
//
//        $serviceOrder->update(['status' => ServiceOrderStatus::DIBATALKAN]);
//        return redirect()->back()
//            ->with('success', 'Pesanan servis berhasil dibatalkan.');
//    }
}
