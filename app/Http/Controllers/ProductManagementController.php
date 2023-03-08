<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductManagementController extends Controller
{
    public function index() {
        return view('admin.manage-product')
            ->with('categories', Category::all());
    }
}
