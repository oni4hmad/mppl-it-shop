<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingComment extends Model
{
    use HasFactory;

    protected $guarded = [
        "komentar",
    ];

    public function prouduct_rating()
    {
        return $this->belongsTo(ProductRating::class);
    }
}
