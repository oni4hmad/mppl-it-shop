<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductManagementController extends Controller
{
    public function index(Request $request) {
//        $product = null;
//        if (!$request->search && !$request->category_id) {
//            $product = Product::latest();
//        }
//        if ($request->category_id) {
//            $product = Product::where('category_id', '=', $request->category_id);
//        }
//        if ($request->search) {
//            $product = $product ? $product->where('nama', 'like', '%'.$request->search.'%')
//                : Product::where('nama', 'like', '%'.$request->search.'%');
//        }

        $product = Product::filter($request->all(['search', 'category']))
            ->latest()
            ->paginate(10)
            ->withQueryString();
        if ($product->currentPage() > $product->lastPage()) {
            return redirect($request->path().'?page='.$product->lastPage().'&search='.$request->search);
        }

        return view('admin.manage-product')
            ->with('categories', Category::all())
            ->with('products', $product);
    }
}
