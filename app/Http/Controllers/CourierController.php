<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\CourierType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourierController extends Controller
{
    public function index()
    {
        return view('admin.manage-courier')
            ->with('couriers', Courier::latest()->get());
    }

    public function storeCourier(Request $request)
    {
        $this->validate($request, [
            "nama" => ["required", Rule::unique('couriers')],
        ]);
        Courier::create($request->all());
        return redirect()
            ->back()
            ->with(['success' => "Kurir berhasil ditambahkan."]);
    }

    public function storeType(Request $request)
    {
        $this->validate($request, [
            "nama" => [
                "required",
                Rule::unique('courier_types', 'nama')->where(function ($query) use ($request) {
                    $courierId = $request->input('courier_id');
                    $query->where('courier_id', $courierId);
                }),
            ],
            "courier_id" => ["required", "exists:courier_types,id"],
            "harga" => ["required", "numeric", "min:0"],
        ]);
        $courier = Courier::find($request->courier_id);
        $courier->courier_types()->create($request->all());
        return redirect()
            ->back()
            ->with(['success' => "Tipe pengiriman berhasil ditambahkan."]);
    }

    public function updateCourier(Courier $courier, Request $request)
    {
        $this->validate($request, [
            "nama" => ["required", Rule::unique('couriers')],
        ]);
        $courier->update($request->all());
        return redirect()
            ->back()
            ->with(['success' => "Kurir berhasil diperbarui."]);
    }

    public function updateType(CourierType $courierType, Request $request)
    {
        $this->validate($request, [
            "nama" => [
                "required",
                Rule::unique('courier_types', 'nama')->where(function ($query) use ($courierType) {
                    $courierId = $courierType->courier->id;
                    $query->where('courier_id', $courierId)
                        ->where('id', '<>', $courierType->id);
                }),
            ],
            "harga" => ["required", "numeric", "min:0"],
        ]);
        $courierType->update([
            "nama" => $request->nama,
            "harga" => $request->harga
        ]);
        return redirect()
            ->back()
            ->with(['success' => "Tipe pengiriman berhasil diperbarui."]);
    }

    public function deleteCourier(Courier $courier)
    {
        $courier->courier_types()->delete();
        $courier->delete();
        return redirect()
            ->back()
            ->with(['success' => "Kurir berhasil dihapus."]);
    }

    public function deleteType(CourierType $courierType)
    {
        $courierType->delete();
        return redirect()
            ->back()
            ->with(['success' => "Tipe pengiriman berhasil dihapus."]);
    }
}
