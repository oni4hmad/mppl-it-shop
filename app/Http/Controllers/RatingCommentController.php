<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\ProductRating;
use App\Models\RatingComment;
use Illuminate\Http\Request;

class RatingCommentController extends Controller
{
    public function store(ProductRating $productRating, Request $request)
    {
        $this->validate($request, [
            "komentar" => ["required"],
        ]);

        // check that who's store comment should be admin
        $isUserAdmin = auth()->user()->user_type == UserType::ADMINISTRATOR;
        if (!$isUserAdmin) {
            return abort(404);
        }

        $ratingComment = new RatingComment(["komentar" => $request->komentar]);
        $ratingComment->product_rating()->associate($productRating);
        $ratingComment->user()->associate(auth()->user());
        $ratingComment->save();
        return redirect()->back()
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function update(RatingComment $ratingComment, Request $request)
    {
        $this->validate($request, [
            "komentar" => ["required"],
        ]);

        // check that who's update comment should be admin
        $isUserAdmin = auth()->user()->user_type == UserType::ADMINISTRATOR;
        if (!$isUserAdmin) {
            return abort(404);
        }

        $ratingComment->update(["komentar" => $request->komentar]);
        return redirect()->back()
            ->with('success', 'Komentar berhasil diperbarui.');
    }

    public function delete(RatingComment $ratingComment)
    {
        // check that who's delete comment should be admin
        $isUserAdmin = auth()->user()->user_type == UserType::ADMINISTRATOR;
        if (!$isUserAdmin) {
            return abort(404);
        }

        $ratingComment->delete();
        return redirect()->back()
            ->with('success', 'Komentar berhasil dihapus.');
    }
}
