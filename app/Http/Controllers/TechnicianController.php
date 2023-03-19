<?php

namespace App\Http\Controllers;

use App\Enums\ServiceOrderStatus;
use App\Enums\TechnicianStatus;
use App\Models\ServiceOrder;
use App\Models\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function showIncomingService()
    {
        $technician = Technician::where('user_id', auth()->user()->id)->first();
        $activeServiceOrder = $technician->service_orders()->active()->first();
        return view('technician.confirm-service-availability')
            ->with('activeServiceOrder', $activeServiceOrder);
    }

    public function acceptServiceRequest(ServiceOrder $serviceOrder)
    {
        // pastikan service order masih status = MENUNGGU_KONFIRMASI_TEKNISI
        // pastikan service order untuk this teknisi
        $isOrderStatusPending = $serviceOrder->status == ServiceOrderStatus::MENUNGGU_KONFIRMASI_TEKNISI;
        $isOrderForThisUser = isset($serviceOrder->technician)
            && $serviceOrder->technician->user_id == auth()->user()->id;
        if (!$isOrderStatusPending || !$isOrderForThisUser) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menerima pesanan: status pesanan mengalami perubahan.');
        }

        // ubah status order menjadi DALAM_SERVIS
        $serviceOrder->status = ServiceOrderStatus::DALAM_SERVIS;

        // ubah status teknisi menjadi DALAM_SERVIS
        $serviceOrder->technician->status = TechnicianStatus::DALAM_SERVIS;
        $serviceOrder->technician->save();
        $serviceOrder->save();

        return redirect()->back()
            ->with('success', 'Pesanan berhasil diterima.');
    }

    public function rejectServiceRequest(ServiceOrder $serviceOrder)
    {
        // pastikan service order masih status = MENUNGGU_KONFIRMASI_TEKNISI
        // pastikan service order untuk this teknisi
        $isOrderStatusPending = $serviceOrder->status == ServiceOrderStatus::MENUNGGU_KONFIRMASI_TEKNISI;
        $isOrderForThisUser = isset($serviceOrder->technician)
            && $serviceOrder->technician->user_id == auth()->user()->id;
        if (!$isOrderStatusPending || !$isOrderForThisUser) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menolak pesanan: status pesanan mengalami perubahan.');
        }

        // ubah status order kembali menjadi MENCARI_TEKNISI
        $serviceOrder->status = ServiceOrderStatus::MENCARI_TEKNISI;

        // ubah status teknisi menjadi TERSEDIA + deassociate teknisi dengan order
        $serviceOrder->technician->status = TechnicianStatus::TERSEDIA;
        $serviceOrder->technician->save();
        $serviceOrder->technician()->dissociate();
        $serviceOrder->save();

        return redirect()->back()
            ->with('success', 'Pesanan berhasil ditolak.');
    }

    public function finishServiceOrder(ServiceOrder $serviceOrder, Request $request)
    {
//        dd($serviceOrder, $request->all());

        // validasi biaya dan rincian harga
        $this->validate($request, [
            "biaya" => ["required", "numeric", "min:0"],
            "rincian_servis" => ["required",],
        ]);

        // pastikan service order masih status = DALAM_SERVIS
        // pastikan service order untuk this teknisi
        $isOrderStatusOnGoing = $serviceOrder->status == ServiceOrderStatus::DALAM_SERVIS;
        $isOrderForThisUser = isset($serviceOrder->technician)
            && $serviceOrder->technician->user_id == auth()->user()->id;
        if (!$isOrderStatusOnGoing || !$isOrderForThisUser) {
            return redirect()->back()
                ->with('error', 'Tidak dapat melakukan konfirmasi selesai pada pesanan: '.
                    'status pesanan mengalami perubahan.');
        }

        // ubah status order kembali menjadi SERVIS_SELESAI
        $serviceOrder->status = ServiceOrderStatus::SERVIS_SELESAI;

        // submit biaya dan rincian servis
        $serviceOrder->biaya = $request->biaya;
        $serviceOrder->rincian_servis = $request->rincian_servis;
        $serviceOrder->save();

        // ubah status teknisi menjadi TERSEDIA
        $serviceOrder->technician->status = TechnicianStatus::TERSEDIA;
        $serviceOrder->technician->save();

        return redirect()->back()
            ->with('success', 'Pesanan berhasil diselesaikan.');
    }
}
