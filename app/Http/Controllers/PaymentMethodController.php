<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return view('admin.manage-payment-method')
            ->with('paymentMethods', PaymentMethod::all());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nama" => ["required", "unique:payment_methods"],
            "nomor_rekening" => ["required", "unique:payment_methods", "regex:/^[0-9\-]+$/"],
        ]);
        PaymentMethod::create($request->all());
        return redirect()
            ->back()
            ->with(['success' => "Metode pembayaran berhasil ditambahkan."]);
    }

    public function update(PaymentMethod $paymentMethod, Request $request)
    {
        $this->validate($request, [
            "nama" => ["required", Rule::unique('payment_methods')->ignore($paymentMethod)],
            "nomor_rekening" => ["required", Rule::unique('payment_methods')->ignore($paymentMethod), "regex:/^[0-9\-]+$/"],
        ]);
        $paymentMethod->update($request->all());
        return redirect()
            ->back()
            ->with(['success' => "Metode pembayaran berhasil diperbarui."]);
    }

    public function delete(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect()
            ->back()
            ->with(['success' => "Metode pembayaran berhasil dihapus."]);
    }
}
