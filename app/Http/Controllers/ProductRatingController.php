<?php

namespace App\Http\Controllers;

use App\Models\ProductStackOrder;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    public function store(ProductStackOrder $productStackOrder, Request $request) {
        $this->validate($request, [
            "nilai_rating" => ["required", "numeric", "min:1", "max:5"],
            "deskripsi_rating" => ["required"],
        ]);

        /* check if this productStackOrder actually owned by this current user */
        if ($productStackOrder->user->id != auth()->user()->id) {
            // TODO: product add rating error handler 1
            return 'error: its not your product stack kekw';
        }

        /* check if productStackOrder has no rating */
        if ($productStackOrder->product_rating()->exists()){
            // TODO: product add rating error handler 2
            return 'error: you already rate this product';
        }

        /* create product rating */
        /* & connect it to product stack order */
        $request->request->add(['user_id' => auth()->user()->id]);
        $request->request->add(['product_id' => $productStackOrder->product_id]);
        $productStackOrder->product_rating()->create($request->all());

        return redirect()->back()
            ->with('success', 'Rating dan review berhasil ditambahkan.');
    }
}
