<?php

namespace App\Http\Controllers;

use App\Enums\ServiceOrderStatus;
use App\Models\AddressOrder;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ServiceOrderController extends Controller
{
    public function showForm()
    {
        return view('service-order');
    }

    public function index()
    {
        return view('order-history-service')
            ->with('serviceOrders', auth()->user()->service_orders()->latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => ["required"],
            "nomor_hp" => ["required", "numeric"],
            "jam" => ["required", "date_format:H:i"],
            "tanggal" => ["required", "date"],
            "deskripsi_masalah" => ["required"],
            "kota" => ["required"],
            "kode_pos" => ["required", "numeric"],
            "alamat" => ["required"]
        ]);

        $jam = $request->input('jam');
        $tanggal = $request->input('tanggal');
        $datetime = "$tanggal $jam";
        $datetimeParsed = Carbon::createFromFormat('Y-m-d H:i', $datetime, 'Asia/Jakarta');
//        dd([$datetime, $datetimeParsed, $request->all()]);
        $request->request->add(['waktu' => $datetimeParsed]);

        $addressOrder = AddressOrder::create($request->all());
        $request->request->add(['address_order_id' => $addressOrder->id]);

        auth()->user()->service_orders()->create($request->all());
        return redirect()->back()
            ->with('success', 'Pemesanan jasa servis berhasil dibuat.');
    }

    public function cancel(ServiceOrder $serviceOrder)
    {
        // making sure that status still at MENCARI_TEKNISI
        if ($serviceOrder->status != ServiceOrderStatus::MENCARI_TEKNISI) {
            return abort(404);
        }

        $serviceOrder->update(['status' => ServiceOrderStatus::DIBATALKAN]);
        return redirect()->back()
            ->with('success', 'Pesanan servis berhasil dibatalkan.');
    }


}
