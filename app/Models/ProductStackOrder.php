<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStackOrder extends Model
{
    use HasFactory;

    protected $guarded = [
        "id",
    ];

    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            ProductOrder::class,
            'id',
            'id',
            'product_order_id',
            'user_id'
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_rating()
    {
        return $this->hasOne(ProductRating::class);
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
