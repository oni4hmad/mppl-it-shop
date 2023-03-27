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
        return $this->hasMany(RatingComment::class);
    }

    public function productStackOrder()
    {
        return $this->belongsTo(ProductStackOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
