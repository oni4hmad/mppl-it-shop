<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductSearchController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::filter($request->all(['search', 'category']))
            ->latest()
            ->paginate(20)
            ->withQueryString();
        if ($product->currentPage() > $product->lastPage()) {
            return redirect($request->path().'?page='.$product->lastPage().'&search='.$request->search);
        }
        return view('search')
            ->with('categories', Category::all())
            ->with('products', $product);
    }

    public function show(Product $product)
    {
        return view('product')
            ->with('product', $product);
    }
}
