<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\ProductRating;
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
            return abort(404);
        }

        /* check if productStackOrder has no rating */
        if ($productStackOrder->product_rating()->exists()){
            return abort(404);
        }

        /* create product rating */
        /* & connect it to product stack order */
        $request->request->add(['user_id' => auth()->user()->id]);
        $request->request->add(['product_id' => $productStackOrder->product_id]);
        $productStackOrder->product_rating()->create($request->all());

        return redirect()->back()
            ->with('success', 'Rating dan review berhasil ditambahkan.');
    }

    public function update(ProductRating $productRating, Request $request)
    {
        $this->validate($request, [
            "nilai_rating" => ["required", "numeric", "min:1", "max:5"],
            "deskripsi_rating" => ["required"],
        ]);

        // check that who's update should be admin, or user that owned the productRating
        $isUserAdmin = auth()->user()->user_type == UserType::ADMINISTRATOR;
        $isUserAuthor = auth()->user()->id == $productRating->user->id;
        if (!$isUserAdmin && !$isUserAuthor) {
            return abort(404);
        }

        $productRating->update([
            "nilai_rating" => $request->nilai_rating,
            "deskripsi_rating" => $request->deskripsi_rating,
        ]);
        return redirect()->back()
            ->with('success', 'Rating dan review berhasil diperbarui.');
    }

    public function delete(ProductRating $productRating)
    {
        // check that who's delete should be admin, or user that owned the productRating
        $isUserAdmin = auth()->user()->user_type == UserType::ADMINISTRATOR;
        $isUserAuthor = auth()->user()->id == $productRating->user->id;
        if (!$isUserAdmin && !$isUserAuthor) {
            return abort(404);
        }

        $productRating->rating_comments()->delete();
        $productRating->delete();
        return redirect()->back()
            ->with('success', 'Rating dan review berhasil dihapus.');
    }
}
