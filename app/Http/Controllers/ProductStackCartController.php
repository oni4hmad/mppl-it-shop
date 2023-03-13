<?php

namespace App\Http\Controllers;

use App\Models\ProductStackCart;
use Illuminate\Http\Request;

class ProductStackCartController extends Controller
{
    public function update(Request $request, ProductStackCart $productStackCart)
    {
        if (isset($request->checked)) {
            $productStackCart->checked = $request->checked;
        }
        if (isset($request->kuantitas)) {
            $productStackCart->kuantitas = $request->kuantitas;
        }
        $productStackCart->save();
        response()->json([
            'error' => false,
        ]);
    }

    public function delete(ProductStackCart $productStackCart)
    {
        $productStackCart->delete();
        response()->json([
            'error' => false,
        ]);
    }
}
