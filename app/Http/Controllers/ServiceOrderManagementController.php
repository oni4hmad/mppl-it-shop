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
}
