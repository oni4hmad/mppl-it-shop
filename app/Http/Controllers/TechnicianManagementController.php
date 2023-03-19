<?php

namespace App\Http\Controllers;

use App\Enums\ServiceOrderStatus;
use App\Models\ServiceOrder;
use App\Models\Technician;
use Illuminate\Http\Request;

class TechnicianManagementController extends Controller
{
    public function index()
    {
        $noTechnicianServiceOrders = ServiceOrder::where('status', ServiceOrderStatus::MENCARI_TEKNISI)->get();
        return view('admin.manage-technician')
            ->with('technicians', Technician::latest()->get())
            ->with('noTechnicianServiceOrders', $noTechnicianServiceOrders);
    }
}
