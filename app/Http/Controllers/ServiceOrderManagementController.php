<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class ServiceOrderManagementController extends Controller
{
    public function index()
    {
        return view('admin.manage-service-order')
            ->with('serviceOrders', ServiceOrder::latest()->get());
    }

    public function cancel(ServiceOrder $serviceOrder)
    {
        // making sure that this order is owned by this user
        $isThisUserServiceOrder = $serviceOrder->user->id == auth()->user()->id;
        if (!$isThisUserServiceOrder) {
            return abort(404);
        }

        // making sure that status still at MENCARI_TEKNISI
        if ($serviceOrder->status != ServiceOrderStatus::MENCARI_TEKNISI) {
            return abort(404);
        }

        $serviceOrder->update(['status' => ServiceOrderStatus::DIBATALKAN]);
        return redirect()->back()
            ->with('success', 'Pesanan servis berhasil dibatalkan.');
    }
}
