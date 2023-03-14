<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;

    protected $guarded = [
        "id",
    ];

    public function rating_comments()
    {
        $this->hasMany(RatingComment::class);
    }
}
