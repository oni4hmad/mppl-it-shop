<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ServiceOrderController extends Controller
{
    public function index()
    {
        return view('service-order');
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
        auth()->user()->service_orders()->create($request->all());
        return redirect()->back()
            ->with('success', 'Pemesanan jasa servis berhasil dibuat.');
    }
}
