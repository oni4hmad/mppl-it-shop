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
        return response()->json([
            'error' => false,
            'request' => $request->all()
        ]);
    }

    public function delete(ProductStackCart $productStackCart)
    {
        $productStackCart->delete();
        return response()->json([
            'error' => false,
        ]);
    }
}
